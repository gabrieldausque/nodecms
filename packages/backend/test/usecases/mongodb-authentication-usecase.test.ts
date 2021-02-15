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

  before(async() => {
    globalInstancesFactory.loadExportedClassesFromDirectory('../../../src/plugins');
    globalInstancesFactory.loadExportedClassesFromDirectory('../../../src/usecases');

    encryptor = globalInstancesFactory.getInstanceFromCatalogs('EncryptionPlugin', 'Default');
  })

  it('Should authenticate a user and return authentication token when giving authorized login and password', async () => {
    const useCase:AuthenticationUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'Authentication', config.get('Authentication'));
    const token = await useCase.create({
      login:
    })
  })

})
