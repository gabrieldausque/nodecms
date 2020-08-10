import AuthenticationPlugin, {CustomAuthenticatedUserToken} from '../../interfaces/AuthenticationPlugin';
import * as process from "process";
import * as os from "os";
const dataLoader = require('csv-load-sync');

export interface LocalAuthenticationConfiguration {
  authorityKey: string;
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
  private authorityKey: string;

  constructor(configuration?:LocalAuthenticationConfiguration) {
    if(configuration) {
      if (configuration.userFile) {
        this.database = dataLoader(configuration.userFile);
      } else {
        this.database = dataLoader('data/users.csv');
      }

      if (configuration.authorityKey) {
        this.authorityKey = configuration.authorityKey
      } else {
        console.warn(`Beware : no authority key provided, default will be used, and it is not secure` )
        this.authorityKey = os.hostname()
      }
    } else {
      this.authorityKey = os.hostname()
    }
  }

  async authenticate(login: string, password: string): Promise<CustomAuthenticatedUserToken> {
    for(const allowedUsers of this.database){
      if(allowedUsers.login === login && allowedUsers.password === password) {
        const token:CustomAuthenticatedUserToken = {
          authenticationDate: new Date(),
          authorityKey: this.authorityKey,
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
