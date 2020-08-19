export default interface AuthenticationPlugin {
  isAuthenticated(decryptedToken:CustomAuthenticatedUserToken):boolean;
  authenticate(login:string, password:string):Promise<CustomAuthenticatedUserToken>
}

export interface CustomAuthenticatedUserToken {
  login:string,
  authenticationDate:Date,
  authorityKey:string
}
