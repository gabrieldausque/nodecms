// @ts-ignore
import chai from 'chai';
// @ts-ignore
import {expect} from 'chai';
import {Server} from "http";
import {globalInstancesFactory} from "@hermes/composition";
import app from "../../src/app";
import axios from "axios";
import {getUrl, initMongoDbTestDatabase} from "../../src/tests/TestsHelpers";
const config = require('config');
// @ts-ignore
import fs from "fs";
import {CSVAuthorizationStorage} from "../../src/plugins/Storages/Authorization/CSVAuthorizationStorage";
// @ts-ignore
import assert from "assert";
import {Authorization} from "../../src/services/authorization/authorization.class";
import {Authorization as AuthorizationEntity} from "../../src/entities/Authorization";
chai.use(require('chai-as-promised'));

const port = app.get('port') || 3030;

describe('Authorization service With Mongodb', () => {

  let server: Server;
  let finalCookie = '';
  let params:any = {};
  let nodeConfigFile = config.get('storage.authorization.configuration')
  let authorizationStorage = globalInstancesFactory.getInstanceFromCatalogs('AuthorizationStorage', 'MongoDb', {

  });

  before(async () => {
    await initMongoDbTestDatabase();
    server = app.listen(port);
    server.once('listening', async () => {
      const authResponse = await axios.request({
        url: getUrl('authentication', 'localhost', port),
        method: "POST",
        data: {
          login: "localtest",
          password: "apassword",
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
    });
  })

  beforeEach(async () => {
    await initMongoDbTestDatabase();
  })

  after((done) => {
    server.close(done);
  })

  it('registered the service', () => {
    const service = app.service('authorization');
    assert.ok(service, 'Registered the service');
  });

  it('should reject call for update method', async () => {

    const service:Authorization = app.service('authorization');
    const updateCall = service.update(0,{
      on:'operation',
      onType:'create',
      right:'x',
      role:1
    },params);
    return Promise.all([
      expect(updateCall).to.be.rejectedWith('Method update is not allowed'),
    ])
  })

  it('should reject call for update method from external client', async () => {
    const updateCall = axios.request({
      url:getUrl('authorization/0'),
      method:"PUT",
      headers: {
        cookie: finalCookie
      }
    })

    const patchCall = axios.request({
      url:getUrl('authorization/0'),
      method:"PATCH",
      headers: {
        cookie: finalCookie
      }
    })
    return Promise.all([
      expect(updateCall).to.be.rejectedWith('Request failed with status code 405'),
      expect(patchCall).to.be.rejectedWith('Request failed with status code 405')
    ])

  })

  it('should create a new right of type operation/create for service metadata and role specialUsers',async () => {
    const service:Authorization = app.service('authorization');
    const created = await service.create({
      on:"operation",
      onType:"create",
      for:"metadata",
      right:"x",
      role:2
    }, params);
    if(created.id){
      const check = await service.get(created.id,params);
      expect(check.data[0]).to.be.eql({
        id:created.data.id,
        on:"operation",
        onType:"create",
        for:"metadata",
        right:"x",
        role:2
      })
    } else {
      assert.fail('created has no id');
    }
  })
  it('should create a new right of type operation/create for service metadata and role specialUsers from external client',async () => {
    const created = await axios.request({
      url:getUrl('authorization'),
      method:"POST",
      data:{
        on:"operation",
        onType:"create",
        for:"metadata",
        right:"x",
        role:2
      },
      headers: {
        cookie: finalCookie
      }
    })

    const check = await axios.request({
      url:getUrl('authorization'),
      method:'GET',
      params: {
        on:"operation",
        onType:"create",
        for:"metadata",
        right:"x",
        role:2
      },
      headers: {
        cookie: finalCookie
      }
    })
    expect(check.data[0]).to.be.eql({
      id:created.data.id,
      on:"operation",
      onType:"create",
      for:"metadata",
      right:"x",
      role:2
    })

  })

  it('should remove a newly created right of type operation/create for service metadata and role specialUsers from external client',async () => {
    const created = await axios.request({
      url:getUrl('authorization'),
      method:"POST",
      data:{
        on:"operation",
        onType:"create",
        for:"metadata",
        right:"x",
        role:2
      },
      headers: {
        cookie: finalCookie
      }
    })
    let check = await axios.request({
      url:getUrl('authorization'),
      method:'GET',
      params: {
        on:"operation",
        onType:"create",
        for:"metadata",
        right:"x",
        role:2
      },
      headers: {
        cookie: finalCookie
      }
    })
    expect(check.data[0]).to.be.eql({
      id:created.data.id,
      on:"operation",
      onType:"create",
      for:"metadata",
      right:"x",
      role:2
    })
    const deleted = await axios.request({
      url:getUrl( `authorization/${created.data.id}`),
      method:"DELETE",
      headers: {
        cookie: finalCookie
      }
    })
    const checkPromise = axios.request({
      url:getUrl('authorization'),
      method:'GET',
      params: {
        on:"operation",
        onType:"create",
        for:"metadata",
        right:"x",
        role:2
      },
      headers: {
        cookie: finalCookie
      }
    })
    return expect(checkPromise).to.be.rejectedWith('Request failed with status code 404');
  })

  it('should remove a newly created right of type operation/create for service metadata and role specialUsers',async () => {
    const service:Authorization = app.service('authorization');
    const created = await service.create({
      on:"operation",
      onType:"create",
      for:"metadata",
      right:"x",
      role:2
    }, params);
    params.query = {
      on:"operation",
      onType:"create",
      for:"metadata",
      right:"x",
      role:2
    };
    let check:AuthorizationEntity[] = await service.find(params) as AuthorizationEntity[];
    expect(check[0]).to.be.eql({
      id:created.id,
      on:"operation",
      onType:"create",
      for:"metadata",
      right:"x",
      role:2
    })
    if(created.id)
      await service.remove(created.id,params);
    const checkPromise = service.find(params);
    return expect(checkPromise).to.be.rejectedWith('No authorization found');
  })

});
