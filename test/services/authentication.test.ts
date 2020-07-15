import assert from 'assert';
import chai from 'chai';
chai.use(require('chai-as-promised'));
import {expect} from 'chai';
import app from '../../src/app';

const port = app.get('port') || 8998;
const getUrl = (pathname?: string) => url.format({
  hostname: app.get('host') || 'localhost',
  protocol: 'http',
  port,
  pathname
});

import LocalAuthentication from "../../src/plugins/Authentication/LocalAuthentication/LocalAuthentication";
import url from "url";
import {Server} from "http";
import axios from "axios";
import {NotAuthenticated} from "@feathersjs/errors";

describe('\'Authentication\' service', () => {
  let server: Server;

  before(function(done) {
    server = app.listen(port);
    server.once('listening', () => done());
  });

  after(function(done) {
    server.close(done);
  });

  it('registered the service', () => {
    const service = app.service('authentication');
    assert.ok(service, 'Registered the service');
  });

  it('should have default authentication plugin created', () => {
    const service = app.service('authentication');
    expect(service.authenticator).to.be.an.instanceof(LocalAuthentication);
  })

  it('should throw error if document service is called without authentication', async () => {
      const fn = async () => {
          const { data } = await axios.get(getUrl('document/0'));
      };
      await expect(fn()).to.be.rejectedWith('Request failed with status code 401');
  })
});
