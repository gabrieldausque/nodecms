
// @ts-ignore
import assert from 'assert';
import app from '../../src/app';

describe('Channel service With Mongodb', () => {
  it('registered the service', () => {
    const service = app.service('channel');
    assert.ok(service, 'Registered the service');
  });



});
