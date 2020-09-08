//@ts-ignore
import assert from 'assert';
import app from '../../src/app';
import * as fs from "fs";
import {CSVAuthorizationStorage} from "../../src/plugins/Storages/Authorization/CSVAuthorizationStorage";
import {expect, getUrl} from '../../src/tests/TestsHelpers'

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
      for:'user'
    })
    expect(found[0]).to.be.eql({
      id:0,
      on:'operation',
      onType:'create',
      for:'*',
      rights:['x'],
      roles:[0]
    })
  })

  it('should create an authorization for an operation of type create and service user', async () => {
    const storage = new CSVAuthorizationStorage(testPath);
    await storage.create({
      on:'operation',
      onType:'create',
      for:'user',
      rights:['x'],
      role:[1]
    })
    const found = storage.find({
      on:'operation',
      onType:'create',
      for:'user'
    })
    expect(found).to.be.eql([{
      id:0,
      on:'operation',
      onType:'create',
      for:'*',
      rights:['x'],
      roles:[0]
    },{
      id:1,
      on:'operation',
      onType:'create',
      for:'user',
      rights:['x'],
      roles:[1]
    }])
  })
});

describe('Authorization service', () => {
  it('registered the service', () => {
    const service = app.service('authorization');

    assert.ok(service, 'Registered the service');
  });
});
