import {MongoDbStorage, MongoDbStorageConfiguration} from "../MongoDbStorage";
import {User} from "../../../entities/User";
import {Logger} from "../../Logging/Logger";
import {globalInstancesFactory} from "@hermes/composition";
import {EncryptionPlugin} from "../../Encryption/EncryptionPlugin";
import {isNumber} from "../../../helpers";

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
    const justCreated = await this.get(data.login);
    return justCreated;
  }

  async delete(loginOrIdOrUser: string | number | User): Promise<User> {
    let user:User;
    if(typeof loginOrIdOrUser === 'string' || typeof loginOrIdOrUser === 'number')
      user = await this.get(loginOrIdOrUser);
    else
      user = loginOrIdOrUser;
    if(user) {
      await this.internalDelete({
        id:user.id
      })
    }
    return user;
  }

  async exists(loginOrIdOrUser: string | number | User): Promise<boolean> {
    let found:User[] = [];
    if(isNumber(loginOrIdOrUser)){
      found = await this.find({ id: parseInt(loginOrIdOrUser.toString())});
    } else if(typeof loginOrIdOrUser === 'string') {
      found = await this.find({login: loginOrIdOrUser.toString()});
    } else if((loginOrIdOrUser as User) && (loginOrIdOrUser as User).login) {
      found = await this.find((loginOrIdOrUser as User));
    }
    return Array.isArray(found) && found.length > 0;
  }

  async find(filter: Partial<User> | undefined): Promise<User[]> {
    let users:User[] = []
    if(filter){
      users = await this.internalFind(filter);
    }
    else {
      users = await this.internalFind({});
    }
    for(const user of users){
      try{
        user.password = this.encryption.decrypt(user.password);
      }catch(err){
          throw err
      }

    }
    return users;
  }

  async get(loginOrId: string | number): Promise<User> {
    let user:User | null = null;
    let toDecrypt = false;
    if(isNumber(loginOrId)){
      user = await this.internalGet(parseInt(loginOrId.toString()))
      toDecrypt = true;
    }else {
      const found = await this.find({login:loginOrId.toString()})
      if(Array.isArray(found) && found.length > 0){
        user = found[0];
      }
    }
    if(!user)
      throw new Error(`No user with login or id ${loginOrId} exists`);
    if(toDecrypt)
      user.password = this.encryption.decrypt(user.password);
    return user;
  }

  async update(data: User): Promise<User> {
    if(data.password) {
      data.password = this.encryption.encrypt(data.password);
    }
    await this.internalUpdate(data);
    return await this.get(data.login)
  }
}
