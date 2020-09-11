//@ts-ignore
import assert from 'assert';
import app from '../../src/app';
import * as fs from "fs";
import {CSVAuthorizationStorage} from "../../src/plugins/Storages/Authorization/CSVAuthorizationStorage";
import {expect, getUrl} from '../../src/tests/TestsHelpers'
import {Server} from "http";
import axios from "axios";
import {globalInstancesFactory} from "@hermes/composition";
const port = app.get('port') || 3030;

describe('Authorization CSV storage', function () {

  const testPath = 'data/authorizations-copy.csv'

  beforeEach((done) => {
    fs.copyFileSync('data/authorizations.csv', 'data/authorizations-copy.csv');
    done();
  })

  it('should get an authorization for an operation of type create and service user', async () => {
    const storage = new CSVAuthorizationStorage(testPath);
    const found = storage.find({
      on:'operation',
      onType:'create',
      for:'user',
      right:'x'
    })
    expect(found[0]).to.be.eql({
      id:0,
      on:'operation',
      onType:'create',
      for:'*',
      right:'x',
      role:0
    })
  })

  it('should get two authorizations for an operation of type delete and service user', async () => {
    const storage = new CSVAuthorizationStorage(testPath);

    const t = [1,0,1];
    const t2 = t.find((i) => i === 1);

    const found = storage.find({
      on:'operation',
      onType:'delete',
      for:'user',
      right:'x'
    })
    expect(found).to.be.eql([{
      id:3,
      on:'operation',
      onType:'delete',
      for:'*',
      right:'x',
      role:0
    },{
      id:6,
      on:'operation',
      onType:'delete',
      for:'user',
      right:'x',
      role:1
    }])
  })

  it('should create an authorization for an operation of type create and service user', async () => {
    const storage = new CSVAuthorizationStorage(testPath);
    const created = await storage.create({
      on:'operation',
      onType:'create',
      for:'user',
      right:'x',
      role:1
    })
    const found = storage.find({
      on:'operation',
      onType:'create',
      right:'x',
      for:'user'
    })
    expect(found).to.be.eql([{
      id:0,
      on:'operation',
      onType:'create',
      for:'*',
      right:'x',
      role:0
    },{
      id:created.id,
      on:'operation',
      onType:'create',
      for:'user',
      right:'x',
      role:1
    }])
  })

  it('should delete an authorization for an operation of type create and service user', async () => {
    const storage = new CSVAuthorizationStorage(testPath);
    const created = await storage.create({
      on:'operation',
      onType:'create',
      for:'user',
      right:'x',
      role:1
    })
    let found = storage.find({
      on:'operation',
      onType:'create',
      right:'x',
      for:'user'
    })
    expect(found).to.be.eql([{
      id:0,
      on:'operation',
      onType:'create',
      for:'*',
      right:'x',
      role:0
    },{
      id:created.id,
      on:'operation',
      onType:'create',
      for:'user',
      right:'x',
      role:1
    }])
    if(!created || !created.id)
      assert.fail('No creation done');
    else {
      await storage.delete(created.id.toString());
      found = storage.find({
        on:'operation',
        onType:'create',
        right:'x',
        for:'user'
      });
      expect(found).to.be.eql([{
        id:0,
        on:'operation',
        onType:'create',
        for:'*',
        right:'x',
        role:0
      }])
    }
  })
});

describe('Authorization service', () => {

  let server: Server;
  let finalCookie = '';
  let authorizationStorage = globalInstancesFactory.getInstanceFromCatalogs('AuthorizationStorage', 'Default');

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
    fs.copyFileSync('data/authorizations.csv', 'data/authorizations-copy.csv');
    (authorizationStorage as CSVAuthorizationStorage).reloadDatabase();
    done();
  })

  after((done) => {
    server.close(done);
  })

  it('registered the service', () => {
    const service = app.service('authorization');
    assert.ok(service, 'Registered the service');
  });

  it('should reject call for update method', async () => {
    const updateCall = axios.request({
      url:getUrl('authorization/0'),
      method:"PUT",
      headers: {
        cookie: finalCookie
      }
    })

    const patchCall = axios.request({
      url:getUrl('authorization/0'),
      method:"PATCH",
      headers: {
        cookie: finalCookie
      }
    })
    return Promise.all([
      expect(updateCall).to.be.rejectedWith('Request failed with status code 405'),
      expect(patchCall).to.be.rejectedWith('Request failed with status code 405')
    ])

  })

  it('should create a new right of type operation/create for service metadata and role specialUsers',async () => {
    const created = await axios.request({
      url:getUrl('authorization'),
      method:"POST",
      data:{
        on:"operation",
        onType:"create",
        for:"metadata",
        right:"x",
        role:2
      },
      headers: {
        cookie: finalCookie
      }
    })

    const check = await axios.request({
      url:getUrl('authorization'),
      method:'GET',
      params: {
        on:"operation",
        onType:"create",
        for:"metadata",
        right:"x",
        role:2
      },
      headers: {
        cookie: finalCookie
      }
    })
    expect(check.data[0]).to.be.eql({
      id:created.data.id,
      on:"operation",
      onType:"create",
      for:"metadata",
      right:"x",
      role:2
    })

  })

  it('should remove a newly created right of type operation/create for service metadata and role specialUsers',async () => {
    const created = await axios.request({
      url:getUrl('authorization'),
      method:"POST",
      data:{
        on:"operation",
        onType:"create",
        for:"metadata",
        right:"x",
        role:2
      },
      headers: {
        cookie: finalCookie
      }
    })
    let check = await axios.request({
      url:getUrl('authorization'),
      method:'GET',
      params: {
        on:"operation",
        onType:"create",
        for:"metadata",
        right:"x",
        role:2
      },
      headers: {
        cookie: finalCookie
      }
    })
    expect(check.data[0]).to.be.eql({
      id:created.data.id,
      on:"operation",
      onType:"create",
      for:"metadata",
      right:"x",
      role:2
    })
    const deleted = await axios.request({
      url:getUrl( `authorization/${created.data.id}`),
      method:"DELETE",
      headers: {
        cookie: finalCookie
      }
    })
    const checkPromise = axios.request({
      url:getUrl('authorization'),
      method:'GET',
      params: {
        on:"operation",
        onType:"create",
        for:"metadata",
        right:"x",
        role:2
      },
      headers: {
        cookie: finalCookie
      }
    })
    return expect(checkPromise).to.be.rejectedWith('Request failed with status code 404');
  })

});
