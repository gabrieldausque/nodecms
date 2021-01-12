//@ts-ignore
import assert from 'assert';
import {Server} from "http";
import axios from "axios";
import * as fs from "fs";
import {getUrl, expect, initMongoDbTestDatabase} from "../../src/tests/TestsHelpers";

import app from '../../src/app';
import {globalInstancesFactory} from "@hermes/composition";
import {Role} from "../../src/services/role/role.class";
import {Role as RoleEntity} from '../../src/entities/Role';
import {getAuthenticationParams} from "../../lib/tests/TestsHelpers";
const port = app.get('port') || 3030;

describe('Role service', () => {

  let server: Server;
  let finalCookie = '';
  let params:any = {}
  let roleStorage = globalInstancesFactory.getInstanceFromCatalogs('RoleStorage','Default');


  before(async () => {
    await initMongoDbTestDatabase();
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
    await initMongoDbTestDatabase();
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

  it('should create a role when asked for from external client', async () => {
    const create = await axios.request({
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
      id:create.data.id,
      key:"newRole",
      description:"A new role"
    })
  })

  it('should create a role when asked for', async () => {
    const service:Role = app.service('role');
    const created:RoleEntity = await service.create(
      {
        key:"newRole",
        description:"A new role"
      },
      params
    )
    const gotten:RoleEntity = await service.get('newRole', params);
    expect(gotten).to.be.eql({
      id:created.id,
      key:"newRole",
      description:"A new role"
    })
  })

  it('should update a role when asked for', async () => {
    const service:Role = app.service('role');
    const created = await service.create({
      key:"newRole",
      description:"A new role"
    }, params);
    if(created.id){
      expect(await service.get(created.id, params)).to.be.eql({
        id:created.id,
        key:"newRole",
        description:"A new role"
      })
      expect(await service.update(created.id, {
        id:created.id,
        key:"newRole",
        description:"A new role updated"
      }, params)).to.be.eql({
        id:created.id,
        key:"newRole",
        description:"A new role updated"
      })
      return expect(await service.patch(created.id, {
        id:created.id,
        key:"newRole",
        description:"A new role patch"
      }, params)).to.be.eql({
        id:created.id,
        key:"newRole",
        description:"A new role patch"
      })
    }
    assert.fail('No id for created')
  })

  it('should delete a role when asked for', async () => {
    const service:Role = app.service('role');
    const created = await service.create({
      key:'newRole',
      description:'A new role'
    }, params);
    const gotten = await service.get('newRole',params);
    expect(gotten).to.be.eql({
      id:created.id,
      key:"newRole",
      description:"A new role"
    });
    if(created.id || created.id === 0)
      await service.remove(created.id, params);
    const p = service.get('newRole',params);
    return expect(p).to.be.rejectedWith('No role with id or key newRole');
  })

  it('should delete a role when asked for from external client', async () => {
    const create = await axios.request({
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
      id:create.data.id,
      key:"newRole",
      description:"A new role"
    })
    await axios.request({
      url: getUrl(`role/${create.data.id}`),
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

  it('should create a role with special user', async() => {
    const service:Role = app.service('role');
    const otherUserParams = await getAuthenticationParams('otheruser', 'anotherpassword', port);
    const created = await service.create({
      key:'newRole',
      description:'A new role'
    }, otherUserParams);
    const gotten = await service.get('newRole',params);
    expect(gotten).to.be.eql({
      id:created.id,
      key:"newRole",
      description:"A new role",
      members:[1]
    });
  })

});
