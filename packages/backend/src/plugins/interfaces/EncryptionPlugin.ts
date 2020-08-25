import {CustomAuthenticatedUserToken} from "./AuthenticationPlugin";

export interface EncryptionPlugin {
  encryptCustomToken(tokenDecrypted: CustomAuthenticatedUserToken): Promise<string>;
  decryptCustomToken(tokenEncrypted: string): Promise<CustomAuthenticatedUserToken>;
  encryptClientId(login:string): string;
  decryptClientId(login:string): string;
}
