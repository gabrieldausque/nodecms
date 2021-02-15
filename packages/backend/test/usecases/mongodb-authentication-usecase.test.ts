import * as chai from 'chai';
import {expect} from 'chai';
import {Server} from "http";
import {globalInstancesFactory} from "@hermes/composition";
import {getUrl, initMongoDbTestDatabase} from "../../src/tests/TestsHelpers";
const config = require('config');
import  * as fs from "fs";
import * as assert from "assert";
import {EncryptionPlugin} from "../../src/plugins/Encryption/EncryptionPlugin";
import {AuthenticationUseCases} from "../../src/usecases/AuthenticationUseCases";
chai.use(require('chai-as-promised'));
const testConfiguration = config.get('authentication');

describe('Authentication use case', () => {

  let encryptor:EncryptionPlugin;
  let configuration: any;

  before(async function(){
    this.timeout(10000);
    globalInstancesFactory.loadExportedClassesFromDirectory(__dirname + '/../../src/plugins');
    globalInstancesFactory.loadExportedClassesFromDirectory(__dirname + '/../../src/usecases');
    await initMongoDbTestDatabase();
    globalInstancesFactory.getInstanceFromCatalogs('UseCases','Role', {
      storage:{...config.get('storage.roles')}
    })
    globalInstancesFactory.getInstanceFromCatalogs('UseCases','User', {
      storage:{...config.get('storage.users')}
    })
    encryptor = globalInstancesFactory.getInstanceFromCatalogs('EncryptionPlugin', 'Default');
    configuration = {...config.get('authentication')};
    configuration.storage = config.get('storage.authentications')
    console.log('init ok');
  });

  it('Should authenticate a user and return authentication token when giving authorized login and password', async () => {
    const useCase:AuthenticationUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'Authentication', configuration);
    const clientUniqueId:string = (new Buffer('127.0.0.1')).toString('base64');
    const token = await useCase.create({
      login: 'localtest',
      password: 'apassword',
      clientUniqueId: clientUniqueId
    })
    expect(token.encryptedToken).to.be.ok;
    if(token.encryptedToken && token.login)
    {
      return expect(useCase.get(token.login, undefined, token.encryptedToken, clientUniqueId)).to.eventually.eql({
        login:'localtest',
        encryptedToken: token.encryptedToken,
        clientUniqueId: clientUniqueId
      })
    } else {
      assert.fail('No correct authentication')
    }
  })

})
