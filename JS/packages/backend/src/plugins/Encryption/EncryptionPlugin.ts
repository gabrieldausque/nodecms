import {CustomAuthenticatedUserToken} from "../Authentication/AuthenticationPlugin";

export interface EncryptionPlugin {
  encryptCustomToken(tokenDecrypted: CustomAuthenticatedUserToken): Promise<string>;
  decryptCustomToken(tokenEncrypted: string): Promise<CustomAuthenticatedUserToken>;
  encryptClientId(uniqueClientId:string): string;
  decryptClientId(encryptedUniqueClientId:string): string;
  encrypt(stringToEncrypt:string):string;
  decrypt(stringToDecrypt:string):string;
}
