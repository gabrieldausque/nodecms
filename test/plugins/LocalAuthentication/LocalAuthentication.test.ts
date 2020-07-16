import assert from 'assert';
import chai from 'chai';
chai.use(require('chai-as-promised'));
import {expect} from 'chai';

import {InstancesFactory} from '@hermes/composition';
import {CustomAuthenticatedUserToken} from "../../../src/plugins/interfaces/AuthenticationPlugin";
const factory = new InstancesFactory();
factory.loadExportedClassesFromDirectory(__dirname + '/../../../src/plugins');

describe('LocalAuthentication plugin tests', () => {
  it('Should authenticate user from local file loaded from configuration', async () => {
    const plugin = factory.getInstanceFromCatalogs('AuthenticationPlugin', 'Default');
    const token:CustomAuthenticatedUserToken = await plugin.authenticate('localtest','apassword');
    expect(token.login).to.be.equal('localtest');
    expect(token.authenticationDate).to.be.ok;
    expect(token.authorityKey).to.be.ok;
  });
})
