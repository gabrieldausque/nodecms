import {globalInstancesFactory} from "@hermes/composition";
import {UserStorage} from '../plugins/Storages/User/UserStorage';
import {UserEntityRules} from "../entities/UserEntityRules";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {UseCases} from "./UseCases";
import {MetadataUseCases} from "./MetadataUseCases";
import {isNumber} from "../helpers";
import {RoleUseCases} from "./RoleUseCases";
import {AuthorizationUseCases} from "./AuthorizationUseCases";
import {Metadata} from "../entities/Metadata";
import {Authorization} from "../entities/Authorization";
import {Role} from "../entities/Role";
import {User} from "../entities/User";
import {Entity} from "../entities/Entity";

export interface UserUseCasesConfiguration extends UseCaseConfiguration {

}

export class UserUseCases extends UseCases<User> {

  public static metadata:any[] = [
    {
      contractType:'UseCases',
      contractName:'User',
      isShared:true
    }
  ]


  constructor(configuration: UserUseCasesConfiguration = {
    storage:{
      contractName:'Default'
    }
  }) {
    super('user','UserStorage',configuration);
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

  async getMetadata(user:User, metadataKeyOrId:string | number):Promise<Metadata> {
    const filter:any = {
      ownerType:'user',
      ownerId:user.id
    }
    const metadataUseCase = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Metadata');
    if(isNumber(metadataKeyOrId)){
      const metadata = metadataUseCase.get(metadataKeyOrId);
      if(metadata.ownerType === 'user' && metadata.ownerId === filter.ownerId) {
        return metadata;
      }
    } else {
      filter.key = metadataKeyOrId;
      const found = metadataUseCase.find(filter);
      if(Array.isArray(found) && found.length > 0){
        return found[0];
      }
    }
    throw new Error(`No metadata with key ${metadataKeyOrId} exists for user with id ${user.id}`);
  }

  async createMetadata(user: User, data: Metadata) {
    const metadataUseCase = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Metadata');
    UserEntityRules.validateMetadata(user, data);
    return await metadataUseCase.create(data);
  }

  async updateMetadata(user: User, data: Metadata) {
    const metadataUseCase = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Metadata');
    UserEntityRules.validateMetadata(user, data);
    return await metadataUseCase.update(data.id, data);
  }

  async hasRole(user: User, role: Role):Promise<boolean> {
    let rolesMetadata:Metadata
    try {
      rolesMetadata = await this.getMetadata(user,'roles');
    }catch(err) {
      rolesMetadata = await this.createMetadata(user, {
        key:'roles',
        value:[]
      });
    }
    return Array.isArray(rolesMetadata.value) &&
      rolesMetadata.value.length >= 1 &&
      rolesMetadata.value.indexOf(role.id) >= 0
  }

  async getRoles(user: User) {
    let rolesMetadata:Metadata;
    try {
      rolesMetadata = await this.getMetadata(user,'roles');
    }catch(err) {
      rolesMetadata = await this.createMetadata(user, {
        key:'roles',
        value:[]
      })
    }
    if(!Array.isArray(rolesMetadata.value) ||
      rolesMetadata.value.length <= 0
    )
      return [];
    const roleUseCases:RoleUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Role');
    const roles:Role[] = [];
    for(const roleId of rolesMetadata.value) {
      roles.push(roleUseCases.get(roleId))
    }
    return roles;
  }

  async hadRole(user: User, role: Role) {
    const hasRole = await this.hasRole(user,role)
    if(!hasRole){
      const rolesMetadata:Metadata = await this.getMetadata(user,'roles');
      rolesMetadata.value.push(role.id);
      await this.updateMetadata(user,rolesMetadata);
    }
  }

  async removeRole(user: User, role: Role) {
    const hasRole = await this.hasRole(user,role)
    if(hasRole){
      const rolesMetadata:Metadata = await this.getMetadata(user,'roles');
      rolesMetadata.value.splice(rolesMetadata.value.indexOf(role.id),1);
      await this.updateMetadata(user,rolesMetadata);
    }
  }

  async isUserAuthorized(user: User, filter: Authorization) : Promise<boolean> {
    for(const role of await this.getRoles(user)){
       const authorizationUseCase:AuthorizationUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Authorization');
       try{
         const authorizations = authorizationUseCase.find({
           ...filter,
           ...{ role:role.id}
         })
         if(authorizations.length > 0){
           return true;
         }
       }catch(err) {
         console.error(err);const authorizations = authorizationUseCase.find({
         ...filter,
         ...{ role:role.id}
       })
       if(authorizations.length > 0){
         return true;
       }
         throw err;
       }
    }
    return false;
  }

  async isDataAuthorized(data:Entity, right:string='r', user?:any):Promise<boolean> {
    return super.isDataAuthorized(data,right,user);
  }
}
