import {globalInstancesFactory} from "@hermes/composition";
import {User, UserStorage} from '../plugins/Storages/User/UserStorage';
import {UserEntity} from "../entities/UserEntity";

export interface UserUseCasesConfiguration {
  storage: {
    contractName: string,
    configuration?: any
  }
}

export class UserUseCases {
  private storage: UserStorage;
  constructor(configuration: UserUseCasesConfiguration = {
    storage:{
      contractName:'Default'
    }
  }) {
    this.storage = globalInstancesFactory.getInstanceFromCatalogs('UserStorage',
      configuration.storage.contractName, configuration.storage.configuration)
  }

  validate(data: any): User {
    if(data.id) {
      data.id = UserEntity.convertId(data.id);
    }

    if(data.login) {
      UserEntity.validateLogin(data.login)
    }

    if(data.password) {
      UserEntity.validatePassword(data.password);
    }

    return data;
  }

  async create(user:User): Promise<User> {
    UserEntity.validatePassword(user.password);
    UserEntity.validateLogin(user.login);
    if(this.storage.exists(user.login))
      throw new Error(`Login ${user.login} already exists. Please change.`)
    return await this.storage.create(user);
  }

  get(idOrLogin: string | number) : User {
    if(UserEntity.validateId(idOrLogin)) {
      const id = UserEntity.convertId(idOrLogin);
      return this.storage.get(id);
    }
    return this.storage.get(idOrLogin);
  }

  find(filter: User) {
    return this.storage.find(filter);
  }

  async update(id: number | string, usertoUpdate: User) : Promise<User> {
    const usableId = UserEntity.convertId(id);
    if(!usableId || typeof usableId !== 'number')
      throw new Error('Please provide a correct id for update.')
    const existingUser = this.get(usableId);

    if(existingUser.id !== usertoUpdate.id ||
    existingUser.login !== usertoUpdate.login) {
      throw new Error('Only active state or password can be updated on a user.')
    }
    UserEntity.validatePassword(usertoUpdate.password);
    return await this.storage.update(usertoUpdate);
  }

  async delete(id: number | string): Promise<User> {
    const usableId = UserEntity.convertId(id);
    if(!usableId || typeof usableId !== 'number')
      throw new Error('Please provide a correct id for delete.')
    return await this.storage.delete(usableId)
  }
}
