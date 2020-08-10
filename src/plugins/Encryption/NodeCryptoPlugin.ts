import {EncryptionPlugin} from '../interfaces/EncryptionPlugin';
import {CustomAuthenticatedUserToken} from '../interfaces/AuthenticationPlugin';
import * as os from 'os';
import crypto from 'crypto';
import {NotAcceptable} from "@feathersjs/errors";

export interface NodeCryptoPluginConfiguration {
  password:string,
  salt:string,
  keyLength:number,
  cipherAlgorithm:string,
}

export class NodeCryptoPlugin implements EncryptionPlugin {
  private cipherAlgorithm: string;
  private password: string;
  private key: string;
  private keyLength: number;
  private salt: string;
  private iv: Buffer;

  constructor(configuration:NodeCryptoPluginConfiguration) {
    // TODO : check the configuration
    this.cipherAlgorithm = configuration.cipherAlgorithm;
    this.password = configuration.password;
    this.keyLength = configuration.keyLength;
    this.salt = configuration.salt;
    // @ts-ignore
    this.key = crypto.scryptSync(this.password, this.salt, this.keyLength);
    this.iv = crypto.randomBytes(16);
  }

  async encrypt(tokenDecrypted: CustomAuthenticatedUserToken): Promise<string> {
    const cipher = crypto.createCipheriv(this.cipherAlgorithm, this.key, this.iv);
    // TODO : check if cipher is an authenticated encryption and throw error if so
    const part1 = cipher.update(JSON.stringify(tokenDecrypted), 'utf8','hex');
    const part2 = cipher.final('hex');
    let encrypted = `${part1}${part2}`
    try {
      encrypted = `${encrypted}:${(cipher as any).getAuthTag().toString('hex')}`;
    }
    catch(ex) {
      // Do nothing, is only to manage authenticated encryption algorithm
    }
    return encrypted;
  }

  decrypt(tokenEncrypted: string): Promise<CustomAuthenticatedUserToken> {
    const decipher = crypto.createDecipheriv(this.cipherAlgorithm, this.key, this.iv);
    const encryptedAsArray = tokenEncrypted.split(':');
    let decrypted:string = '';
    if(encryptedAsArray.length > 1) {
      (decipher as any).setAuthTag(new Buffer(encryptedAsArray[1], 'hex'))
      decrypted = decipher.update(encryptedAsArray[0],'hex','utf8');
    } else {
      decrypted = decipher.update(tokenEncrypted,'hex','utf8');
    }
    return JSON.parse(`${decrypted}${decipher.final('utf8')}`);
  }

}
