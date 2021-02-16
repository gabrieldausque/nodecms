import {EncryptionPlugin} from './EncryptionPlugin';
import {CustomAuthenticatedUserToken} from '../Authentication/AuthenticationPlugin';
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

  public static metadata : any[] = [
    {
      contractType:'EncryptionPlugin',
      contractName:'Default',
      isShared:true
    }
  ]

  constructor(configuration:NodeCryptoPluginConfiguration) {
    // TODO : check the configuration
    this.cipherAlgorithm = configuration.cipherAlgorithm;
    this.password = configuration.password;
    this.keyLength = configuration.keyLength;
    this.salt = configuration.salt;
    // @ts-ignore
    this.key = crypto.scryptSync(this.password, this.salt, this.keyLength);
  }

  encryptClientId(uniqueClientId: string): string {
    const iv = crypto.randomBytes(16);
    const cipher = crypto.createCipheriv(this.cipherAlgorithm, this.key, iv)
    const part1 = cipher.update(`${uniqueClientId}`, 'utf8','hex');
    const part2 = cipher.final('hex');
    let encrypted = `${iv.toString('hex')}:${part1}${part2}`
    try {
      encrypted = `${encrypted}:${(cipher as any).getAuthTag().toString('hex')}`;
    }
    catch(ex) {
      // Do nothing, is only to manage authenticated encryption algorithm that used authTag
    }
    return encrypted;
  }

  decryptClientId(encryptedUniqueClientId: string): string {
    const encryptedAsArray = encryptedUniqueClientId.split(':');
    const decipher = crypto.createDecipheriv(this.cipherAlgorithm, this.key, Buffer.from(encryptedAsArray[0], 'hex'));
    let decrypted:string = '';
    if(encryptedAsArray.length > 2) {
      (decipher as any).setAuthTag(Buffer.from(encryptedAsArray[2], 'hex'));
    }
    decrypted = decipher.update(encryptedAsArray[1],'hex','utf8');
    const decryptedUniqueId = `${decrypted}${decipher.final('utf8')}`;
    return decryptedUniqueId;
  }

  async encryptCustomToken(tokenDecrypted: CustomAuthenticatedUserToken): Promise<string> {
    const iv = crypto.randomBytes(16);
    const cipher = crypto.createCipheriv(this.cipherAlgorithm, this.key, iv);
    const part1 = cipher.update(JSON.stringify(tokenDecrypted), 'utf8','hex');
    const part2 = cipher.final('hex');
    let encrypted = `${iv.toString('hex')}:${part1}${part2}`
    try {
      encrypted = `${encrypted}:${(cipher as any).getAuthTag().toString('hex')}`;
    }
    catch(ex) {
      // Do nothing, is only to manage authenticated encryption algorithm
    }
    return encrypted;
  }

  decryptCustomToken(tokenEncrypted: string): Promise<CustomAuthenticatedUserToken> {
    const encryptedAsArray = tokenEncrypted.split(':');
    const decipher = crypto.createDecipheriv(this.cipherAlgorithm, this.key, Buffer.from(encryptedAsArray[0], 'hex'));
    let decrypted:string = '';
    if(encryptedAsArray.length > 2) {
      (decipher as any).setAuthTag(Buffer.from(encryptedAsArray[2], 'hex'));
    }
    decrypted = decipher.update(encryptedAsArray[1],'hex','utf8');
    const decryptedToken = JSON.parse(`${decrypted}${decipher.final('utf8')}`);
    decryptedToken.authenticationDate = new Date(decryptedToken.authenticationDate);
    return decryptedToken;
  }

  decrypt(stringToDecrypt: string): string {
    return this.decryptClientId(stringToDecrypt);
  }

  encrypt(stringToEncrypt: string): string {
    return this.encryptClientId(stringToEncrypt);
  }

}
