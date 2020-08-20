export default interface AuthenticationPlugin {
  userExists(login:string) : boolean;
  userIsActive(login:string) : boolean;
  tokenNotExpired(decryptedToken:CustomAuthenticatedUserToken) : boolean;
  validAuthorityKey(authorityKey: string) : boolean;
  isAuthenticated(login:string, decryptedToken:CustomAuthenticatedUserToken) : boolean;
  authenticate(login:string, password:string):Promise<CustomAuthenticatedUserToken>;
}

export interface CustomAuthenticatedUserToken {
  login:string,
  authenticationDate:Date,
  authorityKey:string
}
