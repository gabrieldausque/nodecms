export default interface AuthenticationPlugin {
  userExists(login:string) : Promise<boolean>;
  userIsActive(login:string) : Promise<boolean>;
  tokenNotExpired(decryptedToken:CustomAuthenticatedUserToken) : boolean;
  validAuthorityKey(authorityKey: string) : boolean;
  isAuthenticated(login:string, decryptedToken:CustomAuthenticatedUserToken) : boolean;
  authenticate(login:string, password:string):Promise<CustomAuthenticatedUserToken>;
  canAuthenticate(login:string, context?:{clientUniqueId: string}):boolean;
}

export interface CustomAuthenticatedUserToken {
  login:string,
  authenticationDate:Date,
  authorityKey:string
}
