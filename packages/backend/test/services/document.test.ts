import assert from 'assert';
//@ts-ignore
import app from '../../src/app';

describe('\'document\' service', () => {
  it('registered the service', () => {
    const service = app.service('document');

    assert.ok(service, 'Registered the service');
  });
});
