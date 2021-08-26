import AuthenticationPlugin, {CustomAuthenticatedUserToken} from '../AuthenticationPlugin';
import {UserStorage} from '../../Storages/User/UserStorage';
import {globalInstancesFactory} from '@hermes/composition';
import {User} from "@nodecms/backend-data";

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

  constructor(configuration?:LocalAuthenticationConfiguration) {
    if(configuration) {
      if (configuration.storage && configuration.storage.contractName) {
        this.userStorage = globalInstancesFactory.getInstanceFromCatalogs('UserStorage', configuration.storage.contractName, configuration.storage.configuration);
      } else {
        console.warn('Default storage used.')
        this.userStorage = globalInstancesFactory.getInstanceFromCatalogs('UserStorage', 'Default');
      }
    } else {
      console.warn('Default storage used.')
      this.userStorage = globalInstancesFactory.getInstanceFromCatalogs('UserStorage', 'Default');
      console.warn('Default token TTL used.')
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
        login: user.login.toString()
      };
      return token;
    }
    throw new Error(`User ${login} doesn't exist or wrong password or user is deactivated`);
  }

}
