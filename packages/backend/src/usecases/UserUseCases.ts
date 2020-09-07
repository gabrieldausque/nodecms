import {globalInstancesFactory} from "@hermes/composition";
import {User, UserStorage} from '../plugins/Storages/User/UserStorage';
import {UserEntityRules} from "../entities/UserEntityRules";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {UseCases} from "./UseCases";

export interface UserUseCasesConfiguration extends UseCaseConfiguration {

}

export class UserUseCases extends UseCases<User> {
  constructor(configuration: UserUseCasesConfiguration = {
    storage:{
      contractName:'Default'
    }
  }) {
    super('UserStorage',configuration);
  }

  validate(data: any): User {
    if(data.id) {
      data.id = UserEntityRules.convertId(data.id);
    }

    if(data.login) {
      UserEntityRules.validateLogin(data.login)
    }

    if(data.password) {
      UserEntityRules.validatePassword(data.password);
    }

    return data;
  }

  async create(user:User): Promise<User> {
    UserEntityRules.validatePassword(user.password);
    UserEntityRules.validateLogin(user.login);
    if(this.storage.exists(user.login))
      throw new Error(`Login ${user.login} already exists. Please change.`)
    return await this.storage.create(user);
  }

  get(idOrLogin: string | number) : User {
    if(UserEntityRules.validateId(idOrLogin)) {
      const id = UserEntityRules.convertId(idOrLogin);
      return this.storage.get(id);
    }
    return this.storage.get(idOrLogin);
  }

  find(filter: User) {
    return this.storage.find(filter);
  }

  async update(id: number | string, usertoUpdate: User) : Promise<User> {
    const usableId = UserEntityRules.convertId(id);
    if(!usableId || typeof usableId !== 'number')
      throw new Error('Please provide a correct id for update.')
    const existingUser = this.get(usableId);

    if(existingUser.id !== usertoUpdate.id ||
    existingUser.login !== usertoUpdate.login) {
      throw new Error('Only active state or password can be updated on a user.')
    }
    UserEntityRules.validatePassword(usertoUpdate.password);
    return await this.storage.update(usertoUpdate);
  }

  async delete(id: number | string): Promise<User> {
    const usableId = UserEntityRules.convertId(id);
    if(!usableId || typeof usableId !== 'number')
      throw new Error('Please provide a correct id for delete.')
    return await this.storage.delete(usableId)
  }
}
