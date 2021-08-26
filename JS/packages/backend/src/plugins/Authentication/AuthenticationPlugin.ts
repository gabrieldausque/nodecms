export default interface AuthenticationPlugin {

  authenticate(login:string, password:string):Promise<any>;

}

export interface CustomAuthenticatedUserToken {
  login:string,
  authenticationDate:Date,
  authorityKey?:string
  clientUniqueId?: string;
}
