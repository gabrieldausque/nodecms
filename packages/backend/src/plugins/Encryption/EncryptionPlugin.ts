import {CustomAuthenticatedUserToken} from "../Authentication/AuthenticationPlugin";

export interface EncryptionPlugin {
  encryptCustomToken(tokenDecrypted: CustomAuthenticatedUserToken): Promise<string>;
  decryptCustomToken(tokenEncrypted: string): Promise<CustomAuthenticatedUserToken>;
  encryptClientId(login:string): string;
  decryptClientId(login:string): string;
  encrypt(stringToEncrypt:string):string;
  decrypt(stringToDecrypt:string):string;
}
