import AuthenticationPlugin, {CustomAuthenticatedUserToken} from '../../interfaces/AuthenticationPlugin';
import * as process from "process";
import * as os from "os";
const dataLoader = require('csv-load-sync');

export interface LocalAuthenticationConfiguration {
  authorityKey: string;
  userFile: string;
  tokenTTLInSecond: number
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
  private tokenTTL: number;

  constructor(configuration?:LocalAuthenticationConfiguration) {
    if(configuration) {
      // TODO replace by a DAL
      if (configuration.userFile) {
        this.database = dataLoader(configuration.userFile);
      } else {
        console.warn('Default database used.')
        this.database = dataLoader('data/users.csv');
      }

      if (configuration.authorityKey) {
        this.authorityKey = configuration.authorityKey
      } else {
        console.warn(`Beware : no authority key provided, default will be used, and it is not secure` )
        this.authorityKey = os.hostname()
      }

      if(configuration.tokenTTLInSecond) {
        this.tokenTTL = configuration.tokenTTLInSecond;
      } else {
        this.tokenTTL = 86400;
      }

    } else {
      console.warn(`Beware : no authority key provided, default will be used, and it is not secure` )
      console.warn('Default database used.')
      this.authorityKey = os.hostname();

      // TODO replace by a DAL
      this.database = dataLoader('data/users.csv');

      this.tokenTTL = 86400;
    }
  }

  // TODO replace by a DAL
  getUserDatabase() {
    return this.database;
  }

  async authenticate(login: string, password: string): Promise<CustomAuthenticatedUserToken> {
    for(const allowedUsers of this.getUserDatabase()){
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

  isAuthenticated(login:string, decryptedToken:CustomAuthenticatedUserToken): boolean {
    return login === decryptedToken.login &&
      this.validAuthorityKey(decryptedToken.authorityKey) &&
      this.userExists(decryptedToken.login) &&
      this.userIsActive(decryptedToken.login) &&
      this.tokenNotExpired(decryptedToken);
  }

  userExists(login: string) {
    for(const users of this.getUserDatabase()){
      if(users.login === login)
        return true;
    }
    return false;
  }

  userIsActive(login: string) {
    for(const users of this.getUserDatabase()){
      if((users.login === login) && (users.isActive))
        return true;
    }
    return false;
  }

  tokenNotExpired(decryptedToken:CustomAuthenticatedUserToken) {
    return ((Date.now() - decryptedToken.authenticationDate.getTime())/1000) <= this.tokenTTL;
  }

  validAuthorityKey(authorityKey: string) {
    return authorityKey === this.authorityKey;
  }
}
