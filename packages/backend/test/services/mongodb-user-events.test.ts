import * as assert from 'assert';
import * as chai from 'chai';
chai.use(require('chai-as-promised'));
import {expect} from 'chai';
import {Server} from "http";
import axios from "axios";
import {getAuthenticationParams, getUrl, initMongoDbTestDatabase} from "../../src/tests/TestsHelpers";

import app from '../../src/app';
const port = app.get('port') || 3030;

chai.use(require('chai-as-promised'));
import {v4 as uuid} from "uuid";
import {UserEvents} from "../../src/services/user-events/user-events.class";
import {UserAvailabilityStatus, UserEvent, UserEventVisibility} from "@nodecms/backend-data";

describe('UserEvents service', () => {

  let server: Server;
  let finalCookie = '';
  let clientUniqueId = uuid();
  let params:any = {
    route:{},
    query:{}
  };

  before(async () => {
    await initMongoDbTestDatabase();
    server = app.listen(port);
    const p = new Promise((resolve => {
      server.once('listening', async () => {
        const authResponse = await axios.request({
          url: getUrl('authentication'),
          method: "POST",
          data: {
            login: "localtest",
            password: "apassword",
            clientUniqueId:clientUniqueId
          }
        })
        for(const cookie of authResponse.headers['set-cookie']) {
          const cookieString = cookie.split(';')[0];
          const cookieName = cookieString.split('=')[0];
          const cookieValue = cookieString.split('=')[1];
          switch(cookieName) {
            case 'ncms-uniqueid': {
              params.clientId = cookieValue
              break;
            }
            case 'ncms-token': {
              params.authenticationToken = cookieValue;
              break;
            }
            default: {
              params[cookieName] = cookieValue;
            }
          }
          finalCookie += `${cookieString}; `
        }
        resolve(undefined);
      });
    }))
    await p;
  })

  beforeEach(async () => {
    await initMongoDbTestDatabase();
  })

  afterEach(async() => {
    params.route = {};
    params.query = {};
  })

  after((done) => {
    server.close(done);
  })

  it('registered the service', () => {
    const service = app.service('user-events');
    assert.ok(service, 'Registered the service');
  });

  it('should create a user event from standard url', async() => {
    const service:UserEvents = app.service('user-events');
    const now = new Date();
    const toCreate = {
      description: 'The description',
      startDate: new Date(now.getFullYear(), now.getMonth(), now.getDate(), 0,0,0,0),
      endDate: new Date(now.getFullYear(), now.getMonth(), now.getDate(), 23,59,0,0),
      category: 'Vacances',
      label: 'The label',
      location: 'the location',
      ownerAvailabilityStatus: UserAvailabilityStatus.busy,
      visibility: UserEventVisibility.protected
    }
    const expected = {
      ...toCreate,
      ...{
        id:0,
        ownerId:0,
        attachments: [],
        color: '#243dff'
      }
    }

    const created:Partial<UserEvent> = await service.create(toCreate, params);
    expect(created).to.eql(expected);
  })

  it('should create a user event from /user/:idOrLogin/user-events url', async() => {
    const service:UserEvents = app.service('user/:idOrLogin/user-events');
    params.route.idOrLogin = 'localtest';
    const now = new Date();
    const toCreate = {
      description: 'The description',
      startDate: new Date(now.getFullYear(), now.getMonth(), now.getDate(), 0,0,0,0),
      endDate: new Date(now.getFullYear(), now.getMonth(), now.getDate(), 23,59,0,0),
      category: 'Vacances',
      label: 'The label',
      location: 'the location',
      ownerAvailabilityStatus: UserAvailabilityStatus.busy,
      visibility: UserEventVisibility.protected
    }

    const expected = {
      ...toCreate,
      ...{
        id:0,
        ownerId:0,
        attachments: [],
        color: '#243dff'
      }
    }

    const created:Partial<UserEvent> = await service.create(toCreate, params);
    expect(created).to.eql(expected);
  })

  it('should get a user event from standard url', async() => {
    const service:UserEvents = app.service('user-events');

    const now = new Date();
    const toCreate = {
      description: 'The description',
      startDate: new Date(now.getFullYear(), now.getMonth(), now.getDate(), 0,0,0,0),
      endDate: new Date(now.getFullYear(), now.getMonth(), now.getDate(), 23,59,0,0),
      category: 'Vacances',
      label: 'The label',
      location: 'the location',
      ownerAvailabilityStatus: UserAvailabilityStatus.busy,
      visibility: UserEventVisibility.protected
    }
    const expected = {
      ...toCreate,
      ...{
        id:0,
        ownerId:0,
        attachments: [],
        color: '#243dff'
      }
    }

    await service.create(toCreate, params);
    const read:Partial<UserEvent> = await service.get(0, params);
    expect(read).to.eql(expected);
  })

  it('should get a only availability event from standard url for a private event', async() => {
    const service:UserEvents = app.service('user-events');
    const now = new Date();
    const toCreate = {
      description: 'The description',
      startDate: new Date(now.getFullYear(), now.getMonth(), now.getDate(), 0,0,0,0),
      endDate: new Date(now.getFullYear(), now.getMonth(), now.getDate(), 23,59,0,0),
      category: 'Vacances',
      label: 'The label',
      location: 'the location',
      ownerAvailabilityStatus: UserAvailabilityStatus.busy,
      visibility: UserEventVisibility.private
    }
    const expected = {
      description: '',
      startDate: new Date(now.getFullYear(), now.getMonth(), now.getDate(), 0,0,0,0),
      endDate: new Date(now.getFullYear(), now.getMonth(), now.getDate(), 23,59,0,0),
      category: '',
      label: '',
      location: '',
      ownerAvailabilityStatus: UserAvailabilityStatus.busy,
      visibility: UserEventVisibility.private,
      id:0,
      ownerId:0,
      attachments: [],
      color: '#243dff'
    }

    await service.create(toCreate, params);
    const otherParams = await getAuthenticationParams('otheruser', 'anotherpassword', port, clientUniqueId);
    const read:Partial<UserEvent> = await service.get(0, otherParams);
    expect(read).to.eql(expected);
  })

  it('should find all events from standard url for a specific period', async() => {
    const service:UserEvents = app.service('user-events');
    const now = new Date();
    const toCreate = [{
      description: 'The description',
      startDate: new Date(now.getFullYear(), now.getMonth(), 5, 0,0,0,0),
      endDate: new Date(now.getFullYear(), now.getMonth(), 5, 23,59,0,0),
      category: 'Vacances',
      label: 'The label',
      location: 'the location',
      ownerAvailabilityStatus: UserAvailabilityStatus.busy,
      visibility: UserEventVisibility.private
    },{
      description: 'The description 2',
      startDate: new Date(now.getFullYear(), now.getMonth(), 7, 0,0,0,0),
      endDate: new Date(now.getFullYear(), now.getMonth(), 25, 23,59,0,0),
      category: 'Vacances',
      label: 'The label 2 ',
      location: 'the location 2',
      ownerAvailabilityStatus: UserAvailabilityStatus.busy,
      visibility: UserEventVisibility.protected
    }];
    const expected = [{
      ...toCreate[0],
      ...{
        id:0,
        ownerId:0,
        attachments: [],
        color: '#243dff'
      }
    },{
      ...toCreate[1],
      ...{
        id:1,
        ownerId:0,
        attachments: [],
        color: '#243dff'
      }
    }]
    params.query = {
      startDate: new Date(now.getFullYear(), now.getMonth(), 1, 0,0,0,0),
      endDate: new Date(now.getFullYear(), now.getMonth(), 26, 23,59,0,0),
    }
    for(const c of toCreate){
      await service.create(c,params);
    }
    const read:any = await service.find(params);
    expect(read).to.eql(expected);
  })

  it('should find all events from /user/:idOrLogin/user-events url for a specific period', async() => {
    const service:UserEvents = app.service('user/:idOrLogin/user-events');
    const now = new Date();
    const toCreate = [{
      description: 'The description',
      startDate: new Date(now.getFullYear(), now.getMonth(), 5, 0,0,0,0),
      endDate: new Date(now.getFullYear(), now.getMonth(), 5, 23,59,0,0),
      category: 'Vacances',
      label: 'The label',
      location: 'the location',
      ownerAvailabilityStatus: UserAvailabilityStatus.busy,
      visibility: UserEventVisibility.private
    },{
      description: 'The description 2',
      startDate: new Date(now.getFullYear(), now.getMonth(), 7, 0,0,0,0),
      endDate: new Date(now.getFullYear(), now.getMonth(), 25, 23,59,0,0),
      category: 'Vacances',
      label: 'The label 2 ',
      location: 'the location 2',
      ownerAvailabilityStatus: UserAvailabilityStatus.busy,
      visibility: UserEventVisibility.protected
    }];
    const expected = [{
      ...toCreate[0],
      ...{
        id:1,
        ownerId:1,
        attachments: [],
        color: '#243dff'
      }
    },{
      ...toCreate[1],
      ...{
        id:3,
        ownerId:1,
        attachments: [],
        color: '#243dff'
      }
    }]
    const otherParams = await getAuthenticationParams('otheruser', 'anotherpassword', port, clientUniqueId);
    for(const c of toCreate){
      await service.create(c, params);
      await service.create(c,otherParams);
    }
    otherParams.route = {}
    otherParams.route.idOrLogin = 'otheruser';
    otherParams.query = {
      startDate: new Date(now.getFullYear(), now.getMonth(), 1, 0,0,0,0),
      endDate: new Date(now.getFullYear(), now.getMonth(), 26, 23,59,0,0),
    }
    const read:any = await service.find(otherParams);
    expect(read).to.eql(expected);
  })

});
