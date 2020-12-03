import AuthenticationPlugin, {CustomAuthenticatedUserToken} from '../AuthenticationPlugin';
import * as process from "process";
import * as os from 'os';
import {UserStorage} from '../../Storages/User/UserStorage';
import {globalInstancesFactory} from '@hermes/composition';
import {User} from "../../../entities/User";
const dataLoader = require('csv-load-sync');

export interface LocalAuthenticationConfiguration {
  storage?: {
    contractName:string;
    configuration:any
  };
  authorityKey: string;
  userFile: string;
  tokenTTLInSecond: number;
}

export default class LocalAuthentication implements AuthenticationPlugin{
  public static metadata : any[] = [
    {
      contractType:'AuthenticationPlugin',
      contractName:'Default',
      isShared:true
    }
  ]

  public userStorage: UserStorage;
  private authorityKey: string;
  private tokenTTL: number;

  constructor(configuration?:LocalAuthenticationConfiguration) {
    if(configuration) {
      if (configuration.storage && configuration.storage.contractName) {
        this.userStorage = globalInstancesFactory.getInstanceFromCatalogs('UserStorage', configuration.storage.contractName, configuration.storage.configuration);
      } else {
        console.warn('Default storage used.')
        this.userStorage = globalInstancesFactory.getInstanceFromCatalogs('UserStorage', 'Default');
      }

      if (configuration.authorityKey) {
        this.authorityKey = configuration.authorityKey
      } else {
        console.warn(`Beware : no authority key provided, default will be used, and it is not secure.` )
        this.authorityKey = os.hostname()
      }

      if(configuration.tokenTTLInSecond) {
        this.tokenTTL = configuration.tokenTTLInSecond;
      } else {
        console.warn('Default token TTL used.')
        this.tokenTTL = 86400;
      }
    } else {
      console.warn(`Beware : no authority key provided, default will be used, and it is not secure.` )
      this.authorityKey = os.hostname();
      console.warn('Default storage used.')
      this.userStorage = globalInstancesFactory.getInstanceFromCatalogs('UserStorage', 'Default');
      console.warn('Default token TTL used.')
      this.tokenTTL = 86400;
    }
  }

  async getUserDatabase():Promise<User[]> {
    return await this.userStorage.find();
  }

  async authenticate(login: string, password: string): Promise<CustomAuthenticatedUserToken> {
    const user = await this.userStorage.get(login);
    if(user && user.isActive && user.password === password){
      const token:CustomAuthenticatedUserToken = {
        authenticationDate: new Date(),
        authorityKey: this.authorityKey,
        login: user.login.toString()
      };
      return token;
    }
    throw new Error(`User ${login} doesn't exist or wrong password or user is deactivated`);
  }

  isAuthenticated(login:string, decryptedToken:CustomAuthenticatedUserToken): boolean {
    return login === decryptedToken.login &&
      this.validAuthorityKey(decryptedToken.authorityKey) &&
      this.userExists(decryptedToken.login) &&
      this.userIsActive(decryptedToken.login) &&
      this.tokenNotExpired(decryptedToken);
  }

  async userExists(login: string):Promise<boolean> {
    return await this.userStorage.exists(login);
  }

  async userIsActive(login: string):Promise<boolean> {
    if(await this.userExists(login)) {
      const user = await this.userStorage.get(login);
      return (user && user.isActive)?user.isActive:false;
    }
    return  false;
  }

  tokenNotExpired(decryptedToken:CustomAuthenticatedUserToken) {
    return ((Date.now() - decryptedToken.authenticationDate.getTime())/1000) <= this.tokenTTL;
  }

  validAuthorityKey(authorityKey: string) {
    return authorityKey === this.authorityKey;
  }

  canAuthenticate(login: string, context: { clientUniqueId:string }): boolean {
    // TODO : test if login tries < 3
    // TODO : if login tries > 3, calculate login period and that you are in login period (increasing for each newest login tries
    return true;
  }
}
