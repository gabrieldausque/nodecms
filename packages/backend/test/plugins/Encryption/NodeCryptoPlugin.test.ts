// @ts-ignore
import chai from 'chai';
// @ts-ignore
import {expect} from 'chai';
chai.use(require('chai-as-promised'));
import {NodeCryptoPlugin} from "../../../src/plugins/Encryption/NodeCryptoPlugin";
import {CustomAuthenticatedUserToken} from "../../../src/plugins/interfaces/AuthenticationPlugin";
import * as os from "os";
//@ts-ignore
import crypto from 'crypto';

describe('NodeCrypto plugin tests', () => {
  it('should encryptCustomToken and decryptCustomToken a standard token', async () => {

    const encryptor = new NodeCryptoPlugin({
      password:"MySecret",
      cipherAlgorithm:"aes-128-gcm",
      keyLength:16,
      salt:'MySalt'
    })
    const testToken:CustomAuthenticatedUserToken = {
      authenticationDate: new Date(),
      login: "winnie",
      authorityKey: os.hostname()
    }
    expect(JSON.stringify(encryptor.decryptCustomToken(await encryptor.encryptCustomToken(testToken)))).to.be.equal(JSON.stringify(testToken));
  })

  it('should encrypt and decrypt a client id', async () => {

    const encryptor = new NodeCryptoPlugin({
      password:"MySecret",
      cipherAlgorithm:"aes-128-gcm",
      keyLength:16,
      salt:'MySalt'
    })
    const testToken:string = 'toto'
    expect(encryptor.decryptClientId(encryptor.encryptClientId('toto'))).to.be.equal('toto');
  })
});
