import * as assert from 'assert';
import app from '../../src/app';
import * as fs from "fs";
import {expect, getUrl} from '../../src/tests/TestsHelpers'
import {Server} from "http";
import axios from "axios";
import {globalInstancesFactory} from "@hermes/composition";
import {CSVAuthorizationStorage} from "../../src/plugins/Storages/Authorization/CSVAuthorizationStorage";
const port = app.get('port') || 3030;

describe('Document service', () => {

  let server: Server;
  let finalCookie = '';
  let authorizationStorage = globalInstancesFactory.getInstanceFromCatalogs('AuthorizationStorage', 'Default');

  before((done) => {
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
        finalCookie += `${cookie.split(';')[0]}; `
      }
      done();
    });
  })

  beforeEach((done) => {
    done();
  })

  after((done) => {
    server.close(done);
  })

  it('registered the service', () => {
    const service = app.service('document');
    assert.ok(service, 'Registered the service');
  });


});
