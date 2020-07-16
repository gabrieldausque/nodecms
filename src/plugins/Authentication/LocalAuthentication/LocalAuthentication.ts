import AuthenticationPlugin, {CustomAuthenticatedUserToken} from '../../interfaces/AuthenticationPlugin';
const dataLoader = require('csv-load-sync');

export interface LocalAuthenticationConfiguration {
  userFile: string;
}

export default class LocalAuthentication implements AuthenticationPlugin{
  public static metadata : any[] = [
    {
      contractType:'AuthenticationPlugin',
      contractName:'Default',
      isShared:true
    }
  ]

  public database: any;

  constructor(configuration?:LocalAuthenticationConfiguration) {
    if(configuration && configuration.userFile){
      this.database = dataLoader(configuration.userFile);
    } else {
      this.database = dataLoader('data/users.csv');
    }
  }

  async authenticate(login: string, password: string): Promise<CustomAuthenticatedUserToken> {
    for(const allowedUsers of this.database){
      if(allowedUsers.login === login && allowedUsers.password === password) {
        const token:CustomAuthenticatedUserToken = {
          authenticationDate: new Date(),
          authorityKey: 'MyKey',
          login: allowedUsers.login.toString()
        };
        return Promise.resolve(token);
      }
    }
    return Promise.reject(`User ${login} doesn't exist or wrong password`);
  }

  isAuthenticated(login:string,authenticationCreationDate:Date): boolean {
    return false;
  }

}
