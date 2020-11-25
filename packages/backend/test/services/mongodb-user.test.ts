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
import {getUrl, initMongoDbTestDatabase} from "../../src/tests/TestsHelpers";
import {User} from "../../src/entities/User";
import {User as UserService} from '../../src/services/user/user.class';
import {UserMetadata} from "../../src/services/user-metadata/user-metadata.class";
import {UserRoles} from "../../src/services/user-roles/user-roles.class";
import {MongoClient} from "mongodb";
import {MongoDbUserStorage} from "../../src/plugins/Storages/User/MongoDbUserStorage";

const port = app.get('port') || 3030;



describe('User service', () => {

  let server: Server;
  let finalCookie = '';
  let params:any = {};
  let userStorage:MongoDbUserStorage = globalInstancesFactory.getInstanceFromCatalogs('UserStorage','MongoDb');
  let metadataStorage = globalInstancesFactory.getInstanceFromCatalogs('MetadataStorage','MongoDb');
  let authorizationStorage = globalInstancesFactory.getInstanceFromCatalogs('AuthorizationStorage','MondoDb');

  before(async (done) => {
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
      done();
    });
  })

  beforeEach((done) => {
    //TODO : clear the database
    done();
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
    const user:User = await service.get('localtest',params);
    expect(user).to.be.eql({
      id: 0,
      isActive: true,
      login: 'localtest',
      password: '******'
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
      password: '******'
    })
  })

  it('Should create a user if asked for', async () => {
    const response = await axios.request({
      url: getUrl('user'),
      method: "POST",
      data: {
        login: "aNewUser",
        password: "aNewP@ssw0rd",
        isActive: true
      },
      headers: {
        cookie: finalCookie
      }
    })
    assert.fail('To be reimplemented for mongodb case')
  })

  it('Should update a user if asked for', async () => {
    const service:UserService = app.service('user');
    const createdUser = await service.create({
      login: "aNewUser",
      password: "aNewP@ssw0rd",
      isActive: true
    }, params);
    assert.fail('to be reimplemented')
  })

  it('Should update a user if asked for from external client', async () => {
    const creationResponse = await axios.request({
      url: getUrl('user'),
      method: "POST",
      data: {
        login: "aNewUser",
        password: "aNewP@ssw0rd",
        isActive: true
      },
      headers: {
        cookie: finalCookie
      }
    })
    assert.fail('to be reimplemented with mongodb')
  })

  it('Should reject update if id is not related to the login in the data', async () => {
    await axios.request({
      url: getUrl('user'),
      method: "POST",
      data: {
        login: "aNewUser",
        password: "aNewP@ssw0rd",
        isActive: true
      },
      headers: {
        cookie: finalCookie
      }
    })
    assert.fail('to be reimplemented for mongodb')
  })

  it('Should remove a user', async() => {
    await axios.request({
      url: getUrl('user'),
      method: "POST",
      data: {
        login: "aNewUser",
        password: "aNewP@ssw0rd",
        isActive: true
      },
      headers: {
        cookie: finalCookie
      }
    })
    assert.fail('to be reimplemented with mongodb')
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
      id:createResponse.data.id,
      key:'ANewMeta',
      value:'MyNewValue',
      isPublic:false,
      ownerType:'user',
      ownerId:0
    });
    await axios.request({
      url: getUrl('user/localtest/metadata/ANewMeta'),
      method: "DELETE",
      headers: {
        cookie: finalCookie
      }
    });
    const p = axios.request({
      url: getUrl('user/localtest/metadata/ANewMeta'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    });
    expect(p).to.be.rejectedWith('Request failed with status code 404');
  })

  it('should get all role for a user', async() => {
    const service:UserRoles = app.service('user/:idOrLogin/roles');
    if(!params.route)
      params.route = {}
    params.route.idOrLogin = 'localtest';
    const roles = await service.find(params);
    expect(roles).to.be.eql([{
      description: "Administrators group",
      id: 0,
      key: "administrators"
      },
      {
        description: "special Users group",
        id: 2,
        key: "specialUsers"
      }]);
  })

  it('should get all role for a user from external client', async() => {
    let response = await axios.request({
      url: getUrl('user/localtest/roles'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    });
    expect(response.data).to.be.eql([{
      description: "Administrators group",
      id: 0,
      key: "administrators"
      },
      {
        description: "special Users group",
        id: 2,
        key: "specialUsers"
      }]);
  })

  it('should had a role for a user', async() => {
    let response = await axios.request({
      url: getUrl('user/otheruser/roles'),
      method: "POST",
      data: [1],
      headers: {
        cookie: finalCookie
      }
    });
    let list = (await axios.request({
      url: getUrl('user/otheruser/roles'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    })).data;
    expect(list).to.be.eql([{
      description: "Users group",
      id: 1,
      key: "users"
    }]);
    response = await axios.request({
      url: getUrl('user/otheruser/roles/2'),
      method: "PUT",
      headers: {
        cookie: finalCookie
      }
    })
    list = (await axios.request({
      url: getUrl('user/otheruser/roles'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    })).data;
    expect(list).to.be.eql([{
      description: "Users group",
      id: 1,
      key: "users"
    },{
      description: "special Users group",
      id: 2,
      key: "specialUsers"
    }]);
  })

  it('should remove a role for a user', async() => {
    let response = await axios.request({
      url: getUrl('user/otheruser/roles'),
      method: "POST",
      data: [1],
      headers: {
        cookie: finalCookie
      }
    });
    let list = (await axios.request({
      url: getUrl('user/otheruser/roles'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    })).data;
    expect(list).to.be.eql([{
      description: "Users group",
      id: 1,
      key: "users"
    }]);
    response = await axios.request({
      url: getUrl('user/otheruser/roles/1'),
      method: "DELETE",
      headers: {
        cookie: finalCookie
      }
    })
    list = (await axios.request({
      url: getUrl('user/otheruser/roles'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
    })).data;
    expect(list).to.be.eql([]);
  })
});


