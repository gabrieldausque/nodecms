import assert from 'assert';
import chai from 'chai';
chai.use(require('chai-as-promised'));
import {expect} from 'chai';
//@ts-ignore
import app from '../../src/app';

describe('Metadata service', () => {
  it('registered the service', () => {
    const service = app.service('metadata');
    assert.ok(service, 'Registered the service');
  });

  it('should return the title when asking for it', async () => {
    const service = app.service('metadata');
    expect((await service.get('title') as any).value).to.eql('My Node CMS application');
  })
});
