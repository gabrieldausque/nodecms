import {CustomAuthenticatedUserToken} from "./AuthenticationPlugin";

export interface EncryptionPlugin {
  encryptCustomToken(tokenDecrypted: CustomAuthenticatedUserToken): Promise<string>;
  decryptCustomToken(tokenEncrypted: string): Promise<CustomAuthenticatedUserToken>;
  encryptUniqueId(login:string): string;
  decryptUniqueId(login:string): string;
}
