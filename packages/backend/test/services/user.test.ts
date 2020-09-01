//@ts-ignore
import assert from 'assert';
//@ts-ignore
import chai from 'chai';
chai.use(require('chai-as-promised'));
import {expect} from 'chai';
import * as url from "url";
import * as fs from 'fs';
import {User} from "../../src/plugins/interfaces/UserStorage";
const dataLoader = require('csv-load-sync');
fs.copyFileSync('data/users.csv', 'data/users-copy.csv');

import app from '../../src/app';
import {Server} from "http";
import axios from "axios";
import { promisify } from 'util';
import {globalInstancesFactory} from "@hermes/composition";
import {CSVUserStorage} from "../../src/plugins/User/UserStorage/CSVUserStorage";
const port = app.get('port') || 8998;
const getUrl = (pathname?: string) => url.format({
  hostname: app.get('host') || 'localhost',
  protocol: 'http',
  port,
  pathname
});
const sleep = promisify(setTimeout);

describe('User service', () => {

  let server: Server;
  let finalCookie = '';
  let userStorage = globalInstancesFactory.getInstanceFromCatalogs('UserStorage','Default');

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

  beforeEach((done) => {
    fs.copyFileSync('data/users.csv', 'data/users-copy.csv');
    (userStorage as CSVUserStorage).reloadDatabase();
    done();
  })

  after((done) => {
    server.close(done);
  })

  it('registered the service', () => {
    const service = app.service('user');
    assert.ok(service, 'Registered the service');
  });

  it('Should create a user if asked for', async () => {
    const response = await axios.request({
      url: getUrl('user'),
      method: "POST",
      data: {
        login: "aNewUser",
        password: "aNewPassword",
        isActive: true
      },
      headers: {
        cookie: finalCookie
      }
    })
    const database = dataLoader('data/users-copy.csv');
    const newUser = database.find((u:User) => u.login === 'aNewUser');
    expect(newUser.id).to.be.eql('3');
    expect(newUser).to.be.ok;
    expect(newUser.password).to.be.eql('aNewPassword');
    expect(newUser.isActive).to.be.eql('true');

  })

  it('Should update a user if asked for', async () => {
    const creationResponse = await axios.request({
      url: getUrl('user'),
      method: "POST",
      data: {
        login: "aNewUser",
        password: "aNewPassword",
        isActive: true
      },
      headers: {
        cookie: finalCookie
      }
    })
    let database = () => {
      return dataLoader('data/users-copy.csv');
    }
    const newUser = database().find((u:User) => u.login === 'aNewUser');
    expect(newUser).to.be.ok;
    expect(newUser.password).to.be.eql('aNewPassword');
    expect(newUser.isActive).to.be.eql('true');
    const response = await axios.request({
      url: getUrl(`user/${newUser.id}`),
      method: "PUT",
      data: {
        id: "3",
        login: "aNewUser",
        password: "aNewPasswordUpdated",
        isActive: true
      },
      headers: {
        cookie: finalCookie
      }
    })
    let updatedUser = {
      password:null
    };
    const f = async () => {
      updatedUser = database().find((u:User) => u.login === 'aNewUser');
    }
    await f();
    expect(updatedUser.password).to.be.eql('aNewPasswordUpdated');
  })

  it('Should reject update if id is not related to the login in the data', async () => {
    await axios.request({
      url: getUrl('user'),
      method: "POST",
      data: {
        login: "aNewUser",
        password: "aNewPassword",
        isActive: true
      },
      headers: {
        cookie: finalCookie
      }
    })
    let database = () => {
      return dataLoader('data/users-copy.csv');
    }
    const newUser = database().find((u:User) => u.login === 'aNewUser');
    expect(newUser).to.be.ok;
    expect(newUser.password).to.be.eql('aNewPassword');
    expect(newUser.isActive).to.be.eql('true');
    expect(axios.request({
        url: getUrl(`user/${newUser.id}`),
        method: "PUT",
        data: {
          id: "2",
          login: "aNewUser",
          password: "aNewPasswordUpdated",
          isActive: true
        },
        headers: {
          cookie: finalCookie
        }
      })).to.be.rejected;
  })

  it('Should remove a user', async() => {
    await axios.request({
      url: getUrl('user'),
      method: "POST",
      data: {
        login: "aNewUser",
        password: "aNewPassword",
        isActive: true
      },
      headers: {
        cookie: finalCookie
      }
    })
    let database = () => {
      return dataLoader('data/users-copy.csv');
    }
    expect(database().find((u:User) => u.login === 'aNewUser')).to.be.ok;
    await axios.request({
      url: getUrl('user/3'),
      method: "DELETE",
      headers: {
        cookie: finalCookie
      }
    });
    expect(database().find((u:User) => u.login === 'aNewUser')).not.to.be.ok;
  })
});


