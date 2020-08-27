//@ts-ignore
import assert from 'assert';
//@ts-ignore
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
    expect((await service.get('title') as any).value).to.eql('The A Team');
  })

  it('should reject request when asking for a private metadata', async () => {
    const service = app.service('metadata');
    expect(service.get('private-metadata')).to.be.rejected
  })
});
