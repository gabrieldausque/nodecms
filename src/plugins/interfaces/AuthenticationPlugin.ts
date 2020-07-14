export default interface AuthenticationPlugin {
  isAuthenticated():boolean;
  authenticate(login:string, password:string):Promise<void>
}
