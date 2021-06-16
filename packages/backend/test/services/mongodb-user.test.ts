//@ts-ignore
import assert from 'assert';
//@ts-ignore
import chai from 'chai';
chai.use(require('chai-as-promised'));
import {expect} from 'chai';
import * as fs from 'fs';

import app from '../../src/app';
import {Server} from "http";
import axios from "axios";
import {globalInstancesFactory} from "@hermes/composition";
import {getAuthenticationParams, getUrl, initMongoDbTestDatabase} from "../../src/tests/TestsHelpers";
import {User} from "../../../backend-data/src/User";
import {User as UserService} from '../../src/services/user/user.class';
import {UserMetadata} from "../../src/services/user-metadata/user-metadata.class";
import {UserRoles} from "../../src/services/user-roles/user-roles.class";
import {Role as RoleEntity} from '../../../backend-data/src/Role';
import {MongoClient} from "mongodb";
import {MongoDbUserStorage} from "../../src/plugins/Storages/User/MongoDbUserStorage";
import {v4 as uuid} from "uuid";

const port = app.get('port') || 3030;

describe('User service', () => {

  let server: Server;
  let finalCookie = '';
  let clientUniqueId = uuid();
  let params:any = {
    route:{}
  };

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
    const service = app.service('user');
    assert.ok(service, 'Registered the service');
  });

  it('Should return a user from its login without password', async () => {
    const service:UserService = app.service('user');
    const user:Partial<User> = await service.get('localtest',params);
    expect(user).to.be.eql({
      id: 0,
      isActive: true,
      login: 'localtest',
      password: '***'
    })
  })

  it('Should return a user from its login without password from external client', async () => {
    const response = await axios.request({
      url: getUrl('user/localtest'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    });
    expect(response.data).to.be.eql({
      id: 0,
      isActive: true,
      login: 'localtest',
      password: '***'
    })
  })

  it('Should create a user if asked for', async () => {
    const service:UserService = app.service('user');
    const created = await service.create(
      {
        login: "aNewUser",
        password: "aNewP@ssw0rd",
        isActive: true
      }
    , params);
    if(created.login){
      let gotten:Partial<User> = await service.useCase.get(created.login.toString());
      expect(created.id).to.be.eql(gotten.id);
      expect(created.login).to.be.eql(gotten.login);
      expect(created.isActive).to.be.eql(gotten.isActive);
      expect(gotten.password).to.be.eql('aNewP@ssw0rd')
      expect(created.id).to.be.ok;
      if(created.id){
        const id:number = created.id
        gotten = await service.useCase.get(id);
        return Promise.all([
          expect(created.id).to.be.eql(gotten.id),
          expect(created.login).to.be.eql(gotten.login),
          expect(created.isActive).to.be.eql(gotten.isActive),
          expect(gotten.password).to.be.eql('aNewP@ssw0rd')
        ]);
      }
    }
    assert.fail('No id for created user');
  })

  it('Should update a user if asked for', async () => {
    const service:UserService = app.service('user');
    const created = await service.create({
      login: "aNewUser",
      password: "aNewP@ssw0rd",
      isActive: true
    }, params);
    if(created.login) {
      let gotten:Partial<User> = await service.useCase.storage.get(created.login);
      expect({
        ...created,
        ...{ password: "aNewP@ssw0rd" }
      }).to.be.eql(gotten);
      if(created.id){
        const updatedUser = await service.update(created.id, {
          id:created.id,
          login: "aNewUser",
          password: "UpdatedPassword"
        }, params)
        gotten =  await service.useCase.get(created.login);
        return expect(gotten).to.be.eql({
          id: created.id,
          login: created.login,
          password: "UpdatedPassword",
          isActive: true
        })
      }
    }
    assert.fail("no id for created user")
  })

  it('Should reject update if id is not related to the login in the data', async () => {
    const service:UserService = app.service('user');
    const created = await service.create({
      login: "aNewUser",
      password: "aNewP@ssw0rd",
      isActive: true
    }, params);
    if(created.id){
      const wrongUpdatePromise = service.update(created.id, {
        id:666,
        login: "aNewUSer",
        password: "UpdatedPassword",
        isActive: true
      }, params)
      return expect(wrongUpdatePromise).to.be.rejectedWith('Only active state or password can be updated for user by administrators.');
    } else {
      assert.fail('No id in created user');
    }
  })

  it('Should reject update if executing user is not the user and if it is not admin', async () => {
    const service:UserService = app.service('user');
    const created = await service.create({
      login: "aNewUser",
      password: "aNewP@ssw0rd",
      isActive: true
    }, params);
    const otherUserParam:any = await getAuthenticationParams('otheruser', 'anotherpassword', port, clientUniqueId);
    if(created.id){
      const wrongUpdatePromise = service.update(created.id, {
        id:created.id,
        login: "aNewUser",
        password: "UpdatedPassword",
        isActive: true
      }, otherUserParam);
      return expect(wrongUpdatePromise).to.be.rejectedWith(`User otheruser can't update aNewUser. Not same user and has not role administrators`);
    } else {
      assert.fail('No id in created user');
    }
  })

  it('Should remove a user', async() => {
    const service:UserService = app.service('user');
    const created:Partial<User> = await service.create({
      login: "aNewUser",
      password: "aNewP@ssw0rd",
      isActive: true
    }, params);
    if(created.id){
      expect(await service.get(created.id, params)).to.be.eql(created);
      const deleted = await service.remove(created.id, params);
      expect(deleted).to.be.eql(created);
      return expect(service.get(created.id, params)).to.be.rejectedWith(`No user with login or id ${created.id} exists`);
    }
    assert.fail('No id on created user');
  })

  it('should return metadata of a user using login and key', async () => {
    const response = await axios.request({
      url: getUrl('user/localtest/metadata/pseudonym'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    });
    expect(response.data).to.be.eql({
      id:3,
      key:'pseudonym',
      value:'MyPseudo',
      isPublic:false,
      ownerType:'user',
      ownerId:0
    })
  })

  it('should create metadata for a user using login', async () => {
    const createResponse = await axios.request({
      url: getUrl('user/localtest/metadata'),
      method: "POST",
      data: {
        key: "ANewMeta",
        value: "MyNewValue"
      },
      headers: {
        cookie: finalCookie
      }
    });
    const response = await axios.request({
      url: getUrl('user/localtest/metadata/ANewMeta'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    });
    expect(response.data).to.be.eql({
      id: createResponse.data.id,
      key: 'ANewMeta',
      value: 'MyNewValue',
      isPublic: false,
      ownerType: 'user',
      ownerId: 0
    })
  })

  it('should update or patch metadata for a user using login', async () => {
    const service:UserMetadata = app.service('user/:idOrLogin/metadata');
    if(!params.route)
      params.route = {};
    params.route.idOrLogin = 'localtest';
    const createdMetadata = await service.create({
      key: "ANewMeta",
      value: "MyNewValue"
    }, params);
    let gottenMetadata = await service.get('ANewMeta', params);
    expect(gottenMetadata).to.be.eql({
      id: createdMetadata.id,
      key:'ANewMeta',
      value:'MyNewValue',
      isPublic:false,
      ownerType:'user',
      ownerId:0
    })
    if(gottenMetadata && (gottenMetadata.id || gottenMetadata.id === 0)) {
      await service.update(gottenMetadata.id, {
        key: "ANewMeta",
        value: "MyNewValueUpdated"
      }, params);
      gottenMetadata = await service.get('ANewMeta', params);
      expect(gottenMetadata).to.be.eql({
        id: createdMetadata.id,
        key:'ANewMeta',
        value:'MyNewValueUpdated',
        isPublic:false,
        ownerType:'user',
        ownerId:0
      })
      if(gottenMetadata && (gottenMetadata.id || gottenMetadata.id === 0)) {
        await service.patch(gottenMetadata.id, {
          key: "ANewMeta",
          value: "MyNewValuePatch"
        }, params);
        gottenMetadata = await service.get('ANewMeta', params);
        expect(gottenMetadata).to.be.eql({
          id: createdMetadata.id,
          key:'ANewMeta',
          value:'MyNewValuePatch',
          isPublic:false,
          ownerType:'user',
          ownerId:0
        })
      } else {
        assert.fail('metadata not obtained')
      }
    } else {
      assert.fail('metadata not obtained')
    }
  })

  it('should update or patch metadata for a user using login for external client', async () => {
    const createResponse = await axios.request({
      url: getUrl('user/localtest/metadata'),
      method: "POST",
      data: {
        key: "ANewMeta",
        value: "MyNewValue"
      },
      headers: {
        cookie: finalCookie
      }
    });
    let response = await axios.request({
      url: getUrl('user/localtest/metadata/ANewMeta'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    });
    expect(response.data).to.be.eql({
      id: createResponse.data.id,
      key:'ANewMeta',
      value:'MyNewValue',
      isPublic:false,
      ownerType:'user',
      ownerId:0
    })
    await axios.request({
      url: getUrl('user/localtest/metadata/ANewMeta'),
      method: "PUT",
      data: {
        key: "ANewMeta",
        value: "MyNewValueUpdated"
      },
      headers: {
        cookie: finalCookie
      }
    });
    response = await axios.request({
      url: getUrl('user/localtest/metadata/ANewMeta'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    });
    expect(response.data).to.be.eql({
      id: createResponse.data.id,
      key:'ANewMeta',
      value:'MyNewValueUpdated',
      isPublic:false,
      ownerType:'user',
      ownerId:0
    })
    await axios.request({
      url: getUrl('user/localtest/metadata/ANewMeta'),
      method: "PATCH",
      data: {
        key: "ANewMeta",
        value: "MyNewValuePatch"
      },
      headers: {
        cookie: finalCookie
      }
    });
    response = await axios.request({
      url: getUrl('user/localtest/metadata/ANewMeta'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    });
    expect(response.data).to.be.eql({
      id: createResponse.data.id,
      key:'ANewMeta',
      value:'MyNewValuePatch',
      isPublic:false,
      ownerType:'user',
      ownerId:0
    })
  })

  it('should delete a metadata for a user using login', async () => {
    const service:UserMetadata = app.service('user/:idOrLogin/metadata');
    params.route.idOrLogin = "localtest";
    const created = await service.create({
      key: "ANewMeta",
      value: "MyNewValue"
    }, params);
    expect(await service.get(created.key,params)).to.be.eql({
      id:created.id,
      key:'ANewMeta',
      value:'MyNewValue',
      isPublic:false,
      ownerType:'user',
      ownerId:0
    });
    await service.remove(created.key, params);
    return expect(await service.get(created.key,params)).to.be.eql({
      id:created.id,
      key:'ANewMeta',
      value:'',
      isPublic:false,
      ownerType:'user',
      ownerId:0
    });
  })

  it('should get all role for a user', async() => {
    const service:UserRoles = app.service('user/:idOrLogin/roles');
    if(!params.route)
      params.route = {}
    params.route.idOrLogin = 'localtest';
    const roles:any = await service.find(params);
    expect([{
      id:roles[0].id,
      key:roles[0].key,
      description:roles[0].description,
      members: roles[0].members,
      ownerId: roles[0].ownerId
    }]).to.be.eql([{
      description: "Administrators group",
      id: 0,
      key: "administrators",
      members: [0],
      ownerId: 0
      }]);
  })

  it('should add a role for a user', async() => {
    const service:UserRoles = app.service('/user/:idOrLogin/roles');
    params.route = {
      idOrLogin: 'otheruser'
    };
    await service.create([0],params);
    let list = (await axios.request({
      url: getUrl('user/otheruser/roles'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    })).data;
    expect([
      {
        id:list[0].id,
        key:list[0].key,
        description:list[0].description,
        members:list[0].members,
        ownerId:list[0].ownerId
      },{
        id:list[1].id,
        key:list[1].key,
        description:list[1].description,
        members:list[1].members,
        ownerId:list[1].ownerId
      }
    ]).to.be.eql([
      {
        description: "Administrators group",
        id: 0,
        key: "administrators",
        members:[
          0,1
        ],
        ownerId:0
      },
      {
        description: "special Users group",
        id: 1,
        key: "specialUsers",
        members:[
          1
        ],
        ownerId:0
      }
    ]);
  })

  it('should remove a role for a user', async() => {
    const service:UserRoles = app.service('/user/:idOrLogin/roles');
    params.route = {
      idOrLogin: 'otheruser'
    };
    let roles:any = await service.find(params);
    await service.create([0],params);
    roles = await service.find(params);
    expect(roles.length).to.be.eql(2);
    await service.remove(0, params);
    roles = await service.find(params);
    delete roles[0].creationDate;
    expect(roles).to.be.eql([
      {
        description: "special Users group",
        id: 1,
        key: "specialUsers",
        members:[
          1
        ],
        ownerId:0
      }
    ]);
  })

  it('non administrators should not be able to add role for itself or another user', async() => {
    const service = app.service('user/:idOrLogin/roles');
    const otherUserParams = await getAuthenticationParams('otheruser', 'anotherpassword', port, clientUniqueId);
    if(!otherUserParams.route)
      otherUserParams.route = {}
    otherUserParams.route.idOrLogin = 'otheruser';
    let isRejected = false;
    let error;
    try {
      await service.create([1], otherUserParams);
    }
    catch(error)
    {
        isRejected = true
    }
    return expect(isRejected).to.be.true;
  })

});


