import * as assert from 'assert';
import * as chai from 'chai';
chai.use(require('chai-as-promised'));
import {expect} from 'chai';
const config = require('config');

import {InstancesFactory, globalInstancesFactory} from '@hermes/composition';
import {CustomAuthenticatedUserToken} from "../../../src/plugins/Authentication/AuthenticationPlugin";
import {initMongoDbTestDatabase} from "../../../src/tests/TestsHelpers";
import {EncryptionPlugin} from "../../../src/plugins/Encryption/EncryptionPlugin";
const factory = new InstancesFactory();
factory.loadExportedClassesFromDirectory(__dirname + '/../../../src/plugins');

describe('Authentication plugin tests', () => {

  let encryptor:EncryptionPlugin;
  let configuration:any;

  before(async function(){
    this.timeout(10000);
    globalInstancesFactory.loadExportedClassesFromDirectory(__dirname + '/../../../src/plugins');
    globalInstancesFactory.loadExportedClassesFromDirectory(__dirname + '/../../../src/usecases');
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

  it('Should authenticate user from local file loaded from configuration', async () => {
    const plugin = factory.getInstanceFromCatalogs('AuthenticationPlugin', 'Default');
    const token:CustomAuthenticatedUserToken = await plugin.authenticate('localtest','apassword');
    expect(token.login).to.be.equal('localtest');
    expect(token.authenticationDate).to.be.ok;
  });

})
