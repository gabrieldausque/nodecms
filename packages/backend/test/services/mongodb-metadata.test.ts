//@ts-ignore
import assert from 'assert';
//@ts-ignore
import chai from 'chai';
chai.use(require('chai-as-promised'));
import {expect} from 'chai';
//@ts-ignore
import app from '../../src/app';
import {Server} from "http";
import axios from "axios";
import { promisify } from 'util';
import {globalInstancesFactory} from '@hermes/composition';
import * as url from 'url';
import * as fs from "fs";
import {getAuthenticationParams, initMongoDbTestDatabase} from "../../src/tests/TestsHelpers";
import {Metadata as MetaDataService} from '../../src/services/metadata/metadata.class';
import {Metadata} from "../../../backend-data/src/Metadata";
import {v4 as uuid} from "uuid";

const port = app.get('port') || 8998;
const getUrl = (pathname?: string) => url.format({
  hostname: app.get('host') || 'localhost',
  protocol: 'http',
  port,
  pathname
});
const sleep = promisify(setTimeout);

describe('Metadata service', () => {

  let server: Server;
  let params:any = {};
  let finalCookie = '';
  let clientUniqueId = uuid();
  let metadataStorage = globalInstancesFactory.getInstanceFromCatalogs('MetadataStorage','Default');

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

  after((done) => {
    server.close(done);
  })

  it('registered the service', () => {
    const service = app.service('metadata');
    assert.ok(service, 'Registered the service');
  });

  it('should return the title when asking for it', async () => {
    const service = app.service('metadata');
    expect((await service.find({
      query:{
        key:'title'
      }
    }) as any)[0].value).to.eql('The A Team');
  })

  it('should return the title when asking for it with get method', async () => {
    const service = app.service('metadata');
    expect((await service.get('title') as any).value).to.eql('The A Team');
  })

  it('should reject request when asking for a private metadata', async () => {
    const service = app.service('metadata');
    const otherParams = await getAuthenticationParams('otheruser','anotherpassword', port, clientUniqueId);
    return expect(service.get('private-metadata', otherParams)).to.be.rejectedWith('Method get for service metadata is not authorized for user otheruser')
  })

  it('should create a new metadata for the application (no owner type, no owner id) from external client', async () => {
    const service:MetaDataService = app.service('metadata');
    const response = await axios.request({
      url: getUrl('metadata'),
      method: "POST",
      data: {
        key:"newMetadata",
        value:"newValue",
        isPublic:true,
      },
      headers: {
        cookie:finalCookie
      }
    });
    const newMetadata = service.useCase.storage.find({
      key:"newMetadata"
    });
    expect(newMetadata).to.be.ok;
  })

  it('should create a new metadata for the application (no owner type, no owner id)', async () => {
    const service:MetaDataService = app.service('metadata');
    await service.create({
      key:"newMetadata",
      value:"newValue",
      isPublic:true,
    }, params)
    const newMetadata = service.useCase.storage.find({
      key:"newMetadata"
    });
    expect(newMetadata).to.be.ok;
  })

  it('should create a new metadata for a document with id 5)', async () => {
    const service:MetaDataService = app.service('metadata');
    const metadataFromResponse = await service.create(
      {
        key:"newMetadata",
        value:"newValue",
        isPublic:false,
        ownerType: "document",
        ownerId: 5
      }
    ,params);
    const newMetadata:any = service.useCase.storage.find({
      key:"newMetadata",
      ownerType: "document",
      ownerId: 5
    })
    expect(newMetadata).to.be.ok;
    params.query = {
      key:"newMetadata",
      ownerType: "document",
      ownerId: 5
    };
    const readData:Metadata = (await service.find(params) as any)[0];
    expect(readData.id).to.eql(metadataFromResponse.id);
    expect(readData.key).to.eql("newMetadata");
    expect(readData.value).to.eql("newValue");
    expect(readData.isPublic).to.eql(false);
    expect(readData.ownerType).to.eql("document");
    expect(readData.ownerId).to.eql(5);
  })


  it('should create a new metadata for a document with id 5) from external client', async () => {
    const service:MetaDataService = app.service('metadata');
    const response = await axios.request({
      url: getUrl('metadata'),
      method: "POST",
      data: {
        key:"newMetadata",
        value:"newValue",
        isPublic:false,
        ownerType: "document",
        ownerId: 5
      },
      headers: {
        cookie:finalCookie
      }
    });
    const metadataFromResponse = response.data;
    const newMetadata = service.useCase.storage.find({
      key:"newMetadata",
      ownerType: "document",
      ownerId: 5
    })
    expect(newMetadata).to.be.ok;
    const getResponse = await axios.request({
      method:'GET',
      url:getUrl('metadata'),
      params : {
        key:"newMetadata",
        ownerType: "document",
        ownerId: 5
      },
      headers: {
        cookie:finalCookie
      }
    })
    expect(getResponse.data.length).to.eql(1);
    const readData:Metadata = getResponse.data[0];
    expect(readData.id).to.eql(metadataFromResponse.id);
    expect(readData.key).to.eql("newMetadata");
    expect(readData.value).to.eql("newValue");
    expect(readData.isPublic).to.eql(false);
    expect(readData.ownerType).to.eql("document");
    expect(readData.ownerId).to.eql(5);
  })

  it('should update a metadata (no owner type, not owner id) from external client', async () => {
    await axios.request({
      url: getUrl('metadata/title'),
      method: "PUT",
      data: {
        id: 0,
        key:"title",
        value:"My New Title",
      },
      headers: {
        cookie:finalCookie
      }
    });
    const response = await axios.request({
      method:'GET',
      url:getUrl('metadata/title'),
      headers: {
        cookie:finalCookie
      }
    })
    expect(response.data.value).to.be.eql("My New Title")
  })

  it('should update a metadata (no owner type, not owner id)', async () => {
    const service:MetaDataService = app.service('metadata');
    await service.update('title',{
      key:'title',
      value:'My New Title'
    }, params);
    let updated = await service.get('title', params);
    expect(updated.value).to.be.eql("My New Title");
    await service.update(0,{
      key:'title',
      value:'My New Title With Id'
    }, params);
    updated = await service.get(0, params);
    expect(updated.value).to.be.eql("My New Title With Id");
  })

});
