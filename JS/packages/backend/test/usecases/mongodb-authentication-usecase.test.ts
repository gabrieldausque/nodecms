import * as chai from 'chai';
import {expect} from 'chai';
import {globalInstancesFactory} from "@hermes/composition";
import {initMongoDbTestDatabase} from "../../src/tests/TestsHelpers";
const config = require('config');
import * as assert from "assert";
import {EncryptionPlugin} from "../../src/plugins/Encryption/EncryptionPlugin";
import {AuthenticationUseCases} from "../../src/usecases/AuthenticationUseCases";
import {v4 as uuid} from 'uuid';
chai.use(require('chai-as-promised'));


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
    const clientUniqueId:string = uuid();
    const token = await useCase.create({
      login: 'localtest',
      password: 'apassword',
      clientUniqueId: clientUniqueId
    })
    expect(token).to.be.ok;
    if(token)
    {
      return expect(useCase.get('localtest', undefined, token, await useCase.encryptClientId(clientUniqueId))).to.eventually.eql(token)
    } else {
      assert.fail('No correct authentication')
    }
  })

})
