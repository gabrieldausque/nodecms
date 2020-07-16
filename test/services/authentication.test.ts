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

  it('should throw error if any service are called without authentication', async () => {
      const fn = async () => {
          const { data } = await axios.get(getUrl('document/0'));
      };
      await expect(fn()).to.be.rejectedWith('Request failed with status code 401');
  })

  it('should throw error if authentication find, remove or patch method is called', async () => {
    const find = async () => {
      const { data } = await axios.request({
        url: getUrl('authentication'),
        method:"GET"
      });
    };

    const remove = async () => {
      const { data } = await axios.request({
        url:getUrl('authentication/0'),
        method:"DELETE"
      });
    };

    const patch = async () => {
      const { data } = await axios.request(
        {
          url: getUrl('authentication/0'),
          method:"PATCH"
        });
    };

    await expect(find()).to.be.rejectedWith('Request failed with status code 405').then(async () => {
      await expect(remove()).to.be.rejectedWith('Request failed with status code 405');
    }).then(async() => {
      await expect(patch()).to.be.rejectedWith('Request failed with status code 405');
    })
  })

});
