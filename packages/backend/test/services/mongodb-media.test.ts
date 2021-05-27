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
import {Media, MediaVisibility} from '../../../backend-data/src/Media';
import axios from "axios";
import * as fs from 'fs';
import {v4 as uuid} from "uuid";

const readFile = promisify(fs.readFile);


const port = app.get('port') || 8998;
const getUrl = (pathname?: string) => url.format({
  hostname: app.get('host') || 'localhost',
  protocol: 'http',
  port,
  pathname
});
const sleep = promisify(setTimeout);

describe('Media service', () => {

  let server: Server;
  let params:any = {};
  let finalCookie = '';
  let clientUniqueId = uuid();
  let mediaStorage = globalInstancesFactory.getInstanceFromCatalogs('MediaStorage','Default');

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
    if(fs.existsSync('test/uploads'))
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
    const file = await readFile('test/data/smiley.png');
    const created = await service.create({
      visibility: MediaVisibility.public,
      blob:file,
      label: 'A smiley',
      key: 'smiley'
    }, params);
    if(created && (created.id || created.id === 0)){
      const readFile = await service.get(created.id, params);
      if(readFile && readFile.blob){
        return Promise.all([
          expect(readFile).to.be.ok,
          expect(readFile.blob).to.be.ok,
          expect(fs.existsSync(`${readFile.storagePath}`)).to.be.true,
          expect(readFile.blob).to.be.eql(file)]);
      }
    }
    assert.fail('No id for created');
  });

  it('Should delete a media  when asked for', async() => {
    const service:MediaService = app.service('media');
    const file = await readFile('test/data/smiley.png');
    const created = await service.create({
      visibility: MediaVisibility.public,
      blob:file,
      label: 'Smiley',
      key: 'A Smiley'
    }, params);
    await sleep(500);
    if(created && (created.id || created.id === 0)){
      const deletedFile = await service.remove(created.id.toString(), params);
      if(deletedFile){
        expect(deletedFile).to.be.ok;
        expect(deletedFile.blob).to.be.undefined;
        expect(fs.existsSync(`${deletedFile.storagePath}`)).to.be.false;
        return expect(service.get(created.id, params)).to.be.rejectedWith(`No media with key or id ${created.id}.`);
      }
    }
    assert.fail('No id for created');
  });

  it('Should reject not authorized file mime type', async() => {
    const service:MediaService = app.service('media');
    const file = await readFile('test/data/WrongFile.js');
    const created = service.create({
      visibility: MediaVisibility.public,
      blob:file,
      label: 'Wrong File',
      key: 'gfmljfm fmlhjmh'
    }, params);
    return expect(created).to.be.rejectedWith('Mime types text/plain is not authorized for upload');
  })

});
