import assert from 'assert';
import chai from 'chai';
chai.use(require('chai-as-promised'));
import {expect} from 'chai';
//@ts-ignore
import app from '../../src/app';

const port = app.get('port') || 8998;
const getUrl = (pathname?: string) => url.format({
  hostname: app.get('host') || 'localhost',
  protocol: 'http',
  port,
  pathname
});

//@ts-ignore
import LocalAuthentication from '../../src/plugins/Authentication/LocalAuthentication/LocalAuthentication';
import url from "url";
import {Server} from "http";
import axios from "axios";
import {NotAuthenticated} from "@feathersjs/errors";
//@ts-ignore
import {Authentication} from '../../src/services/authentication/authentication.class';
import * as os from "os";

describe('Authentication service', () => {
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
      const service = app.service('authentication');
      const fn = async () => {
        const { data } = await axios.request({
          method:'get',
          url: getUrl('document/0'),
          headers: {
            "ncms-uniqueid": service.encryptor.encryptClientId('toto'),
            "www-authenticate": 'Bearer realm=localhost.local.domain'
          }
        });
      };
      await expect(fn()).to.be.rejectedWith('Request failed with status code 401');
  })

  it('should throw error if any service are called with authentication from other realm', async () => {
    const service = app.service('authentication');
    const fn = async () => {
      const { data } = await axios.request({
        method:'get',
        url: getUrl('document/0'),
        headers: {
          "authorization": `Bearer ${service.create({ login: 'localtest', password: 'apassword'})}`,
          "www-authenticate": 'Bearer realm=otherdomain.com',
          "ncms-uniqueid": service.encryptor.encryptClientId('localtes')
        }
      });
    };
    await expect(fn()).to.be.rejectedWith('Request failed with status code 501');
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

  it('should create authentication token, set it in the response header, and be able to use it in further request', async() => {

    const response = await axios.request({
      url: getUrl('authentication'),
      method: "POST",
      data: {
        login: "localtest",
        password: "apassword",
      }
    })
    expect(response.headers['authorization']).to.be.ok;
    const service = app.service('authentication') as Authentication;
    const customToken = await service.encryptor.decryptCustomToken(response.headers['authorization'].replace('Bearer ', ''));
    expect(customToken.login).to.be.eq('localtest');
  })

  it('should have the right realm set on create authentication', async () => {
    const response = await axios.request({
      url: getUrl('authentication'),
      method: "POST",
      data: {
        login: "localtest",
        password: "apassword",
      }
    })
    const regexp = /Bearer[ ]+realm=(?<realm>[^ ]+)/g
    const authenticateHeader = response.headers['www-authenticate'];
    const realm = regexp.exec(authenticateHeader)?.groups?.realm;
    expect(realm).to.be.eql('localhost.local.domain');
  })

  it('should invalidate a wrong login token', async () => {
    const encryptedToken = await (app.service('authentication') as Authentication).encryptor.encryptCustomToken({
      login: 'aWrongLogin',
      authenticationDate: new Date(),
      authorityKey: os.hostname()
    })
    const response = await axios.request({
      url: getUrl('authentication/aWrongLogin'),
      method: 'GET',
      headers: {
        authorization: `Bearer ${encryptedToken}`
      }
    })
    expect(response.data).to.be.false;
  })

  it('should invalidate an expired token', async () => {
    const encryptedToken = await (app.service('authentication') as Authentication).encryptor.encryptCustomToken({
      login: 'localtest',
      authenticationDate: new Date("2020-01-01"),
      authorityKey: os.hostname()
    })
    const response = await axios.request({
      url: getUrl('authentication/localtest'),
      method: 'GET',
      headers: {
        authorization: `Bearer ${encryptedToken}`
      }
    })
    expect(response.data).to.be.false;
  })

  it('should invalidate a wrong authority key token', async () => {
    const encryptedToken = await (app.service('authentication') as Authentication).encryptor.encryptCustomToken({
      login: 'localtest',
      authenticationDate: new Date(),
      authorityKey: "wrongAuthority"
    })
    const response = await axios.request({
      url: getUrl('authentication/localtest'),
      method: 'GET',
      headers: {
        authorization: `Bearer ${encryptedToken}`
      }
    })
    expect(response.data).to.be.false;
  })

  it('should invalidate a good token used with another login', async () => {
    const encryptedToken = await (app.service('authentication') as Authentication).encryptor.encryptCustomToken({
      login: 'localtest',
      authenticationDate: new Date(),
      authorityKey: os.hostname()
    })
    const response = await axios.request({
      url: getUrl('authentication/otheruser'),
      method: 'GET',
      headers: {
        authorization: `Bearer ${encryptedToken}`
      }
    })
    expect(response.data).to.be.false;
  })



});
