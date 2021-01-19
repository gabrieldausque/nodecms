import assert from 'assert';
import app from '../../src/app';

describe('\'webthumbnail\' service', () => {
  it('registered the service', () => {
    const service = app.service('webthumbnail');

    assert.ok(service, 'Registered the service');
  });
});
