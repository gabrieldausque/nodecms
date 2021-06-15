import * as chai from 'chai';
import {expect} from 'chai';
import {Server} from "http";
import {globalInstancesFactory} from "@hermes/composition";
import app from "../../src/app";
import axios from "axios";
import {getUrl, initMongoDbTestDatabase} from "../../src/tests/TestsHelpers";
const config = require('config');
import * as assert from "assert";
import {v4 as uuid} from 'uuid'
import {Authentication} from "../../src/services/authentication/authentication.class";

chai.use(require('chai-as-promised'));

const port = app.get('port') || 3030;

describe('Authentication service With Mongodb', () => {

  let server: Server;
  let finalCookie = '';
  let params: any = {};
  let clientUniqueId = uuid();
  let nodeConfigFile = config.get('storage.authorization.configuration')
  let authorizationStorage = globalInstancesFactory.getInstanceFromCatalogs('AuthorizationStorage', 'MongoDb', {});

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
    if(server)
      server.close(() => {
        done()
      });
  })

  it('registered the service', () => {
    const service = app.service('authentication');
    assert.ok(service, 'Registered the service');
  });

  it('should authenticate a user and create the token', async () => {
    const result = await axios.request({
      url: getUrl('authentication', 'localhost', port),
      method: "POST",
      data: {
        login: "localtest",
        password: "apassword",
        clientUniqueId: clientUniqueId
      }
    })
    expect(result.data).to.eql('OK');
  })

  it('should reject a user with wrong password', async ()=> {
    const service:Authentication = app.service('authentication');
    const authPromise = service.create({
      login:'localtest',
      password: 'awrongpassword',
      clientUniqueId: clientUniqueId
    })
    return expect(authPromise).to.be.rejectedWith('User localtest doesn\'t exist or wrong password or user is deactivated');
  })

  it('should reject a non existing user', async ()=> {
    const service:Authentication = app.service('authentication');
    const authPromise = service.create({
      login:'NonExistingUser',
      password: 'awrongpassword',
      clientUniqueId: clientUniqueId
    })
    return expect(authPromise).to.be.rejectedWith('No user with login or id NonExistingUser exists');
  })

  it('should reject a inactive user', async ()=> {
    const service:Authentication = app.service('authentication');
    const authPromise = service.create({
      login:'inactiveuser',
      password: 'anything',
      clientUniqueId: clientUniqueId
    })
    return expect(authPromise).to.be.rejectedWith('User inactiveuser can\'t authenticate for now, please retry later');
  })

  it('should check authentication for an already active session', async() => {
    const service:Authentication = app.service('authentication');
    const result = await service.find(params);
    expect(result).to.eql(params.authenticationToken);
    let response = await axios.request({
      url: getUrl('/authentication'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    })
    expect(response.data).to.eql('OK');
  })

  it('should clear cookie in case of calling remove for logout', async() => {
    let response = await axios.request({
      url: getUrl('/authentication'),
      method: "DELETE",
      headers: {
        cookie: finalCookie
      }
    })
    return expect(response.data).to.be.eql('Logged Out');
  })


})
