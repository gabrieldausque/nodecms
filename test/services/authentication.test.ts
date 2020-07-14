import assert from 'assert';
import {expect} from 'chai';
import app from '../../src/app';
import LocalAuthentication from "../../src/plugins/LocalAuthentication/LocalAuthentication";

describe('\'Authentication\' service', () => {
  it('registered the service', () => {
    const service = app.service('authentication');

    assert.ok(service, 'Registered the service');
  });

  it('should have default authentication plugin created', () => {
    const service = app.service('authentication');
    expect(service.authenticator).to.be.an.instanceof(LocalAuthentication);
  })
});
