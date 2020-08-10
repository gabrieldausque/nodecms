import {CustomAuthenticatedUserToken} from "./AuthenticationPlugin";

export interface EncryptionPlugin {
  encrypt(tokenDecrypted: CustomAuthenticatedUserToken): Promise<string>;
  decrypt(tokenEncrypted: string): Promise<CustomAuthenticatedUserToken>;
}
