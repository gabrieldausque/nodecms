export default interface AuthenticationPlugin {
  isAuthenticated(login:string,authenticationCreationDate:Date):boolean;
  authenticate(login:string, password:string):Promise<CustomAuthenticatedUserToken>
}

export interface CustomAuthenticatedUserToken {
  login:string,
  authenticationDate:Date,
  authorityKey:string
}
