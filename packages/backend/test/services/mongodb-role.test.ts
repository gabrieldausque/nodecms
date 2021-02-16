
import * as assert from 'assert';
import {Server} from "http";
import axios from "axios";
import * as fs from "fs";
import {getUrl, expect, initMongoDbTestDatabase} from "../../src/tests/TestsHelpers";

import app from '../../src/app';
import {globalInstancesFactory} from "@hermes/composition";
import {Role} from "../../src/services/role/role.class";
import {Role as RoleEntity} from '../../src/entities/Role';
import {getAuthenticationParams} from "../../src/tests/TestsHelpers";
import {v4 as uuid} from "uuid";
const port = app.get('port') || 3030;

describe('Role service', () => {

  let server: Server;
  let finalCookie = '';
  let params:any = {};
  let clientUniqueId = uuid();
  let roleStorage = globalInstancesFactory.getInstanceFromCatalogs('RoleStorage','Default');


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
    expect({
      id:response.data.id,
      key:response.data.key,
      description: response.data.description,
      members: response.data.members,
      ownerId: response.data.ownerId
    }).to.be.eql({
      id:0,
      key:"administrators",
      description:"Administrators group",
      members:[0],
      ownerId:0
    })
    response = await axios.request({
      url: getUrl('role/0'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    })
    expect({      id:response.data.id,
      key:response.data.key,
      description: response.data.description,
      members: response.data.members,
      ownerId: response.data.ownerId}).to.be.eql({
      id:0,
      key:"administrators",
      description:"Administrators group",
      members:[0],
      ownerId: 0
    })
  })

  it('should find a role when asked for', async() => {
    const service:Role = app.service('role');
    params.filter = {
      key:'specialUsers'
    }
    const found:any = await service.find(params);
    expect(found.length).to.be.eql(1)
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
    expect({      id:response.data.id,
      key:response.data.key,
      description: response.data.description,
      members: response.data.members,
      ownerId: response.data.ownerId}).to.be.eql({
      id:create.data.id,
      key:"newRole",
      description:"A new role",
      members:[0],
      ownerId:0
    })
  })

  it('should create a role when asked for', async () => {
    const service:Role = app.service('role');
    const created = await service.create(
      {
        key:"newRole",
        description:"A new role",
      },
      params
    )
    const gotten = await service.get('newRole', params);
    expect({
      id:gotten.id,
      key:gotten.key,
      description:gotten.description,
      members:gotten.members,
      ownerId:gotten.ownerId
    }).to.be.eql({
      id:created.id,
      key:"newRole",
      description:"A new role",
      members:[0],
      ownerId:0
    })
  })

  it('should update a role when asked for', async () => {
    const service:Role = app.service('role');
    const created = await service.create({
      key:"newRole",
      description:"A new role"
    }, params);
    if(created.id){
      let gotten = await service.get(created.id, params);
      expect({
        id:gotten.id,
        key:gotten.key,
        description:gotten.description,
        members:gotten.members,
        ownerId:gotten.ownerId
      }).to.be.eql({
        id:created.id,
        key:"newRole",
        description:"A new role",
        members:[0],
        ownerId:0
      })
      gotten = await service.update(created.id, {
        id:created.id,
        key:"newRole",
        description:"A new role updated"
      }, params);
      expect({
        id:gotten.id,
        key:gotten.key,
        description:gotten.description,
        members:gotten.members,
        ownerId:gotten.ownerId
      }).to.be.eql({
        id:created.id,
        key:"newRole",
        description:"A new role updated",
        members:[0],
        ownerId:0
      })
      gotten = await service.patch(created.id, {
        id:created.id,
        key:"newRole",
        description:"A new role patch"
      }, params);
      return expect({
        id:gotten.id,
        key:gotten.key,
        description:gotten.description,
        members:gotten.members,
        ownerId:gotten.ownerId
      }).to.be.eql({
        id:created.id,
        key:"newRole",
        description:"A new role patch",
        members:[0],
        ownerId:0
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
    expect({
      id:gotten.id,
      key:gotten.key,
      description:gotten.description,
      members:gotten.members,
      ownerId:gotten.ownerId
    }).to.be.eql({
      id:created.id,
      key:"newRole",
      description:"A new role",
      members: [0],
      ownerId: 0
    });
    if(created.id || created.id === 0)
      await service.remove(created.id, params);
    const p = service.get('newRole',params);
    return expect(p).to.be.rejectedWith('No role with id or key newRole');
  })

  it('should create a role with special user', async() => {
    const service:Role = app.service('role');
    const otherUserParams = await getAuthenticationParams('otheruser', 'anotherpassword', port, clientUniqueId);
    const created = await service.create({
      key:'newRole',
      description:'A new role'
    }, otherUserParams);
    const gotten = await service.get('newRole',params);
    expect({
      id:gotten.id,
      key:gotten.key,
      description:gotten.description,
      members:gotten.members,

    }).to.be.eql({
      id:created.id,
      key:"newRole",
      description:"A new role",
      members:[1]
    });
  })

  it('should create a role with standard user', async() => {
    const service:Role = app.service('role');
    const otherUserParams = await getAuthenticationParams('standarduser', 'standard', port, clientUniqueId);
    const created = await service.create({
      key:'newRole',
      description:'A new role'
    }, otherUserParams);
    const gotten = await service.get('newRole',params);
    expect({
      id:gotten.id,
      key:gotten.key,
      description:gotten.description,
      members:gotten.members,

    }).to.be.eql({
      id:created.id,
      key:"newRole",
      description:"A new role",
      members:[2]
    });
  })

  it('should add member for owner', async() => {
    const service:Role = app.service('role');
    const otherUserParams = await getAuthenticationParams('otheruser', 'anotherpassword', port, clientUniqueId);
    const created = await service.create({
      key:'newRole',
      description:'A new role'
    }, otherUserParams);
    if(typeof created.id === 'number' && Array.isArray(created.members)){
      await service.update(created.id, {
        description:'My New Descriptions',
        members: [...created.members,2,3]
      }, otherUserParams)
      const gotten = await service.get('newRole',params);
      expect({
        id:gotten.id,
        key:gotten.key,
        description:gotten.description,
        members:gotten.members,

      }).to.be.eql({
        id:created.id,
        key:"newRole",
        description:"My New Descriptions",
        members:[1,2,3]
      });
    } else {
      assert.fail('No id for new role');
    }
  })

  it('should throw exception if special user trying to add member in not owned group', async() => {
    const service:Role = app.service('role');
    const otherUserParams = await getAuthenticationParams('otheruser', 'anotherpassword', port, clientUniqueId);
    const updatePromise = service.update(0, {
      description:'My New Descriptions',
      members: [2]
    }, otherUserParams)
    return expect(updatePromise).to.be.rejectedWith('Data to update is not authorized for your account');
  })

  it('should add member for owner for standard', async() => {
    const service:Role = app.service('role');
    const otherUserParams = await getAuthenticationParams('standarduser', 'standard', port, clientUniqueId);
    const created = await service.create({
      key:'newRole',
      description:'A new role'
    }, otherUserParams);
    if(typeof created.id === 'number' && Array.isArray(created.members)){
      await service.update(created.id, {
        description:'My New Descriptions',
        members: [...created.members,4,3]
      }, otherUserParams)
      const gotten = await service.get('newRole',params);
      expect({
        id:gotten.id,
        key:gotten.key,
        description:gotten.description,
        members:gotten.members,

      }).to.be.eql({
        id:created.id,
        key:"newRole",
        description:"My New Descriptions",
        members:[2,4,3]
      });
    } else {
      assert.fail('No id for new role');
    }
  })

  it('should throw exception if standard user trying to add member in not owned group', async() => {
    const service:Role = app.service('role');
    const otherUserParams = await getAuthenticationParams('standarduser', 'standard', port, clientUniqueId);
    const updatePromise = service.update(0, {
      description:'My New Descriptions',
      members: [2]
    }, otherUserParams)
    return expect(updatePromise).to.be.rejectedWith('Data to update is not authorized for your account');
  })

});
