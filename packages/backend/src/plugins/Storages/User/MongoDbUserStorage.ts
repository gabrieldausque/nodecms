import {MongoDbStorage, MongoDbStorageConfiguration} from "../MongoDbStorage";
import {User} from "../../../entities/User";
import {Logger} from "../../Logging/Logger";
import {globalInstancesFactory} from "@hermes/composition";
import {EncryptionPlugin} from "../../Encryption/EncryptionPlugin";

export interface MongoDbUserStorageConfiguration extends MongoDbStorageConfiguration{
  encryptionPluginContractName:string
}

export class MongoDbUserStorage extends MongoDbStorage<User> {
  public static metadata : any[] = [
    {
      contractType:'UserStorage',
      contractName:'MongoDb',
      isShared:true
    }
  ]

  private readonly encryption: EncryptionPlugin;

  constructor(configuration:MongoDbUserStorageConfiguration) {
    super(configuration);
    this.encryption = globalInstancesFactory.getInstanceFromCatalogs('EncryptionPlugin',configuration.encryptionPluginContractName);
  }

  async create(data: User): Promise<User> {
    if(!await this.exists(data.login)) {
      const newUser:User = {
        id: await this.getNewId(),
        login: data.login,
        password: this.encryption.encrypt(data.password),
        isActive: data.isActive
      }
      await this.internalCreate(newUser);
    } else {
      this.logger?.debug('user already exists');
    }
    return await this.get(data.login);
  }

  delete(keyOrId: string | number | User): Promise<User> {
    throw new Error("Not implemented");
  }

  exists(keyOrId: string | number | User): Promise<boolean> {
    return Promise.resolve(false);
  }

  async find(filter: User | undefined): Promise<User[]> {
    if(filter){
      return await this.internalFind(filter);
    }
    return this.internalFind();
  }

  get(keyOrId: string | number): Promise<User> {
    throw new Error("Not implemented");
  }

  update(data: User): Promise<User> {
    throw new Error("Not implemented");
  }

}
