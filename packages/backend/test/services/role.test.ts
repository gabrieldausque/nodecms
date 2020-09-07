//@ts-ignore
import assert from 'assert';
import {Server} from "http";
import axios from "axios";
import * as fs from "fs";
import {getUrl, expect} from "../../src/tests/TestsHelpers";


fs.copyFileSync('data/roles.csv', 'data/roles-copy.csv');

import app from '../../src/app';
import {globalInstancesFactory} from "@hermes/composition";
import {Storage} from "../../src/plugins/Storages/Storage";
import {RoleStorage} from "../../src/plugins/Storages/Role/RoleStorage";
import {CSVRoleStorage} from "../../src/plugins/Storages/Role/CSVRoleStorage";
const port = app.get('port') || 3030;

describe('Role service', () => {

  let server: Server;
  let finalCookie = '';
  let roleStorage = globalInstancesFactory.getInstanceFromCatalogs('RoleStorage','Default');


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
    fs.copyFileSync('data/roles.csv', 'data/roles-copy.csv');
    (roleStorage as CSVRoleStorage).reloadDatabase();
    done();
  })

  after((done) => {
    server.close(done);
  })

  it('registered the service', () => {
    const service = app.service('role');

    assert.ok(service, 'Registered the service');
  });

  it('should get a role when asked for', async() => {
    let response = await axios.request({
      url: getUrl('role/administrators'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    })
    expect(response.data).to.be.eql({
      id:0,
      key:"administrators",
      description:"Administrators group"
    })
    response = await axios.request({
      url: getUrl('role/0'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    })
    expect(response.data).to.be.eql({
      id:0,
      key:"administrators",
      description:"Administrators group"
    })
  })

  it('should return 404 when search for unknown role', async() => {
    const p = axios.request({
      url: getUrl('role/unknownGroups'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    })
    return expect(p).to.be.rejectedWith('Request failed with status code 404');
  })

  it('should create a role when asked for', async () => {
    await axios.request({
      url: getUrl('role'),
      method: "POST",
      data: {
        key:"newRole",
        description:"A new role"
      },
      headers: {
        cookie: finalCookie
      }
    })
    const response = await axios.request({
      url: getUrl('role/newRole'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    })
    expect(response.data).to.be.eql({
      id:2,
      key:"newRole",
      description:"A new role"
    })
  })

  it('should update a role when asked for', async () => {
    await axios.request({
      url: getUrl('role'),
      method: "POST",
      data: {
        key:"newRole",
        description:"A new role"
      },
      headers: {
        cookie: finalCookie
      }
    })
    let response = await axios.request({
      url: getUrl('role/newRole'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    })
    expect(response.data).to.be.eql({
      id:2,
      key:"newRole",
      description:"A new role"
    })
    await axios.request({
      url: getUrl('role/2'),
      method: "PUT",
      data: {
        id:2,
        key:"newRole",
        description:"A new role updated"
      },
      headers: {
        cookie: finalCookie
      }
    })
    response = await axios.request({
      url: getUrl('role/2'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    })
    expect(response.data).to.be.eql({
      id:2,
      key:"newRole",
      description:"A new role updated"
    })
    await axios.request({
      url: getUrl('role/newRole'),
      method: "PATCH",
      data: {
        key:"newRole",
        description:"A new role patch"
      },
      headers: {
        cookie: finalCookie
      }
    })
    response = await axios.request({
      url: getUrl('role/2'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    })
    expect(response.data).to.be.eql({
      id:2,
      key:"newRole",
      description:"A new role patch"
    })
  })

  it('should delete a role when asked for', async () => {
    await axios.request({
      url: getUrl('role'),
      method: "POST",
      data: {
        key:"newRole",
        description:"A new role"
      },
      headers: {
        cookie: finalCookie
      }
    })
    const response = await axios.request({
      url: getUrl('role/newRole'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    })
    expect(response.data).to.be.eql({
      id:2,
      key:"newRole",
      description:"A new role"
    })
    await axios.request({
      url: getUrl('role/2'),
      method: "DELETE",
      headers: {
        cookie: finalCookie
      }
    })
    const p = axios.request({
      url: getUrl('role/newRole'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    });
    return expect(p).to.be.rejectedWith('Request failed with status code 404');
  })
});
