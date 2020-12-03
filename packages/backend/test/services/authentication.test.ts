//@ts-ignore
import assert from 'assert';
//@ts-ignore
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
//@ts-ignore
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

  it('should throw error if wrong authentication', async () => {
    const service = app.service('authentication');
    return Promise.all([expect(service.create({
      login:'toto',
      password: 'wrongpassword'
    })).to.be.rejectedWith('No user with login or id toto exists')])
  })

  it('should throw error if wrong password for existing user', async () => {
    const service:Authentication = app.service('authentication');
    return Promise.all([expect(service.create({
      login:'localtest',
      password: 'wrongpassword'
    })).to.be.rejectedWith('User localtest doesn\'t exist or wrong password or user is deactivated')])
  })

  it('should throw error if any service are called without authentication', async () => {
      const service = app.service('authentication');
      const fn = async () => {
        const { data } = await axios.request({
          method:'get',
          url: getUrl('document/0'),
          headers: {
            "cookie": `ncms-uniqueid=${service.encryptor.encryptClientId('toto')} ; realm=myhost.domain`
          }
        });
      };
      await expect(fn()).to.be.rejectedWith('Request failed with status code 401');
  })

  it('should throw error if any service are called with authentication from other realm', async () => {
    const service = app.service('authentication');
    const p = axios.request({
        method:'get',
        url: getUrl('document/0'),
        headers: {
          "cookie": `ncms-token=${await service.create({ login: 'localtest', password: 'apassword'})} ; ncms-uniqueid=${service.encryptor.encryptClientId('toto')} ; realm=other.domain`
        }
      });
    await expect(p.catch((err) => { console.error(err); throw err; } )).to.be.rejectedWith('Request failed with status code 501');
  })

  it('should throw error if authentication find or patch method is called', async () => {
    const find = async () => {
      const { data } = await axios.request({
        url: getUrl('authentication'),
        method:"GET"
      });
    };

    const patch = async () => {
      const { data } = await axios.request(
        {
          url: getUrl('authentication/0'),
          method:"PATCH"
        });
    };

    await Promise.all([
      expect(find()).to.be.rejectedWith('Request failed with status code 405'),
      expect(patch()).to.be.rejectedWith('Request failed with status code 405')
    ])

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
    expect(response.headers['set-cookie']).to.be.ok;
    const service = app.service('authentication') as Authentication;
    const tokenFromCookie = response.headers['set-cookie'].find((c:any) => {
      return c.includes('ncms-token');
    });
    const regexp = /ncms-token=(?<token>.*) +;/g
    const m = regexp.exec(tokenFromCookie);
    if(m && m.groups && m.groups.token)
    {
      const customToken = await service.encryptor.decryptCustomToken(m.groups.token);
      expect(customToken.login).to.be.eq('localtest');
    } else {
      throw new Error('Token not found');
    }
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
    const service = app.service('authentication') as Authentication;
    const realmFromCookie = response.headers['set-cookie'].find((c:any) => {
      return c.includes('realm');
    });
    const regexp = /realm=(?<realm>.*) +;/g
    const m = regexp.exec(realmFromCookie);
    if(m && m.groups && m.groups.realm)
    {
      expect(m.groups.realm).to.be.eql('myhost.domain');
    } else {
      throw new Error('realm not found');
    }
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
