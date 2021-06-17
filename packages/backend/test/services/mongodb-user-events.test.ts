import assert from 'assert';
import app from '../../src/app';

describe('\'UserEvents\' service', () => {
  it('registered the service', () => {
    const service = app.service('user-events');

    assert.ok(service, 'Registered the service');
  });
});
