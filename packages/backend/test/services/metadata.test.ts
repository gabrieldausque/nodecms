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
import {Metadata, MetadataStorage} from "../../src/plugins/Storages/Metadata/MetadataStorage";
import {CSVMetadataStorage} from "../../src/plugins/Storages/Metadata/CSVMetadataStorage";
const dataLoader = require('csv-load-sync');
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
  let finalCookie = '';
  let metadataStorage = globalInstancesFactory.getInstanceFromCatalogs('MetadataStorage','Default');

  before((done) => {
    server = app.listen(port);
    server.once('listening', async () => {
      const authResponse = await axios.request({
        url: getUrl('authentication'),
        method: "POST",
        data: {
          login: "localtest",
          password: "apassword",
        }
      })
      for(const cookie of authResponse.headers['set-cookie']) {
        finalCookie += `${cookie.split(';')[0]}; `
      }
      done();
    });
  })

  const database = () => {
    return dataLoader('data/metadata-copy.csv');
  }

  beforeEach((done) => {
    fs.copyFileSync('data/metadata.csv', 'data/metadata-copy.csv');
    (metadataStorage as CSVMetadataStorage).reloadDatabase();
    done();
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
    expect((await service.get('title') as any).value).to.eql('The A Team');
  })

  it('should reject request when asking for a private metadata', async () => {
    const service = app.service('metadata');
    expect(service.get('private-metadata')).to.be.rejected
  })

  it('should create a new metadata for the application (no owner type, no owner id)', async () => {
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
    const newMetadata = database().find((m:any) => m.key === "newMetadata");
    expect(newMetadata).to.be.ok;
  })

  it('should create a new metadata for a document with id 5)', async () => {
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
    const newMetadata = database().find((m:any) => m.key === "newMetadata" &&
      m.ownerType === "document" &&
      m.ownerId === "5"
    );
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
    expect(readData.id).to.eql(3);
    expect(readData.key).to.eql("newMetadata");
    expect(readData.value).to.eql("newValue");
    expect(readData.isPublic).to.eql(false);
    expect(readData.ownerType).to.eql("document");
    expect(readData.ownerId).to.eql(5);
  })

  it('should update a metadata (no owner type, not owner id)', async () => {
    let response = await axios.request({
      url: getUrl('metadata/title'),
      method: "PUT",
      data: {
        key:"title",
        value:"My New Title",
      },
      headers: {
        cookie:finalCookie
      }
    });
    response = await axios.request({
      url: getUrl('metadata/0'),
      method: "PUT",
      data: {
        key:"title",
        value:"My New Title",
      },
      headers: {
        cookie:finalCookie
      }
    });
  })

});
