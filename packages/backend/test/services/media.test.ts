import assert from 'assert';
import app from '../../src/app';

describe('\'media\' service', () => {
  it('registered the service', () => {
    const service = app.service('media');

    assert.ok(service, 'Registered the service');
  });
});
