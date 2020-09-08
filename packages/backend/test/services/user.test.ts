//@ts-ignore
import assert from 'assert';
//@ts-ignore
import chai from 'chai';
chai.use(require('chai-as-promised'));
import {expect} from 'chai';
import * as fs from 'fs';
import {User} from '../../src/plugins/Storages/User/UserStorage';
const dataLoader = require('csv-load-sync');
fs.copyFileSync('data/users.csv', 'data/users-copy.csv');
fs.copyFileSync('data/metadata.csv', 'data/metadata-copy.csv');

import app from '../../src/app';
import {Server} from "http";
import axios from "axios";
import {globalInstancesFactory} from "@hermes/composition";
import {CSVUserStorage} from "../../src/plugins/Storages/User/CSVUserStorage";
import {CSVMetadataStorage} from "../../src/plugins/Storages/Metadata/CSVMetadataStorage";
import {getUrl} from "../../src/tests/TestsHelpers";
const port = app.get('port') || 3030;

describe('User service', () => {

  let server: Server;
  let finalCookie = '';
  let userStorage = globalInstancesFactory.getInstanceFromCatalogs('UserStorage','Default');
  let metadataStorage = globalInstancesFactory.getInstanceFromCatalogs('MetadataStorage','Default');

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
    fs.copyFileSync('data/users.csv', 'data/users-copy.csv');
    fs.copyFileSync('data/metadata.csv', 'data/metadata-copy.csv');
    (userStorage as CSVUserStorage).reloadDatabase();
    (metadataStorage as CSVMetadataStorage).reloadDatabase();
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
    const response = await axios.request({
      url: getUrl('user/localtest'),
      method: "GET",
      headers: {
        cookie: finalCookie
      }
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
    const database = dataLoader('data/users-copy.csv');
    const newUser = database.find((u:User) => u.login === 'aNewUser');
    expect(newUser.id).to.be.eql('3');
    expect(newUser).to.be.ok;
    expect(newUser.password).to.be.eql('aNewP@ssw0rd');
    expect(newUser.isActive).to.be.eql('true');

  })

  it('Should update a user if asked for', async () => {
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
    let database = () => {
      return dataLoader('data/users-copy.csv');
    }
    const newUser = database().find((u:User) => u.login === 'aNewUser');
    expect(newUser).to.be.ok;
    expect(newUser.password).to.be.eql('aNewP@ssw0rd');
    expect(newUser.isActive).to.be.eql('true');
    const response = await axios.request({
      url: getUrl(`user/${newUser.id}`),
      method: "PUT",
      data: {
        id: "3",
        login: "aNewUser",
        password: "aNewP@ssw0rdUpdated",
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
    expect(updatedUser.password).to.be.eql('aNewP@ssw0rdUpdated');
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
    let database = () => {
      return dataLoader('data/users-copy.csv');
    }
    const newUser = database().find((u:User) => u.login === 'aNewUser');
    expect(newUser).to.be.ok;
    expect(newUser.password).to.be.eql('aNewP@ssw0rd');
    expect(newUser.isActive).to.be.eql('true');
    expect(axios.request({
        url: getUrl(`user/${newUser.id}`),
        method: "PUT",
        data: {
          id: 2,
          login: "aNewUser",
          password: "aNewP@ssw0rdUpdated",
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
        password: "aNewP@ssw0rd",
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


