// @ts-ignore
import assert from 'assert';

import app from '../../src/app';
// @ts-ignore
import url from "url";
import {promisify} from "util";
import {Server} from "http";
import {globalInstancesFactory} from "@hermes/composition";
import {expect,getAuthenticationParams, initMongoDbTestDatabase} from "../../src/tests/TestsHelpers";
import {Media as MediaService} from "../../src/services/media/media.class";
import {Media, MediaVisibility} from '../../src/entities/Media';
import axios from "axios";
import * as fs from 'fs';

const readFile = promisify(fs.readFile);


const port = app.get('port') || 8998;
const getUrl = (pathname?: string) => url.format({
  hostname: app.get('host') || 'localhost',
  protocol: 'http',
  port,
  pathname
});
const sleep = promisify(setTimeout);

describe('\'media\' service', () => {

  let server: Server;
  let params:any = {};
  let finalCookie = '';
  let mediaStorage = globalInstancesFactory.getInstanceFromCatalogs('MediaStorage','Default');

  before(async () => {
    await initMongoDbTestDatabase();
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
    fs.rmdirSync('test/uploads', {
      recursive:true
    });
    await initMongoDbTestDatabase();
    params.route = {};
  })

  after((done) => {
    server.close(done);
  })

  it('registered the service', () => {
    const service = app.service('media');

    assert.ok(service, 'Registered the service');
  });

  it('Should create a media file and store it to disk', async() => {
    const service:MediaService = app.service('media');
    const file = await readFile('test/data/foo.txt');
    const created = await service.create({
      visibility: MediaVisibility.public,
      blob:file,
      label: 'Foo',
      key: 'foo.txt'
    }, params);
    if(created && (created.id || created.id === 0)){
      const readFile = await service.get(created.id, params);
      if(readFile && readFile.blob){
        expect(readFile).to.be.ok;
        expect(readFile.blob).to.be.ok;
        expect(readFile.blob.toString()).to.be.ok;
        return expect(await readFile.blob.toString()).to.be.eql('Foo\n');
      }
    }
    assert.fail('No id for created');
  })
});
