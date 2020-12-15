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

  async create(user:Partial<User>, executingUser:User): Promise<User> {
    UserEntityRules.validatePassword(user.password);
    UserEntityRules.validateLogin(user.login);
    if(user.login && await this.storage.exists(user.login))
      throw new Error(`Login ${user.login} already exists. Please change.`)
    const created = await this.storage.create(user);
    const roleUseCase = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Role');
    await this.addRole(created, await roleUseCase.get('users'), executingUser);
    return created;
  }

  async get(idOrLogin: string | number, executingUser?:User) : Promise<User> {
    if(UserEntityRules.validateId(idOrLogin)) {
      const id = UserEntityRules.convertId(idOrLogin);
      return await this.storage.get(id);
    }
    return await this.storage.get(idOrLogin);
  }

  async find(filter: User, executingUser:User):Promise<User[]> {
    return await this.storage.find(filter);
  }

  //TODO : create a usecase where only admin users can update the active state
  async update(id: number | string, usertoUpdate: User, executingUser:User) : Promise<User> {
    const usableId = UserEntityRules.convertId(id);
    if(!usableId || typeof usableId !== 'number')
      throw new Error('Please provide a correct id for update.')

    const existingUser = await this.get(usableId, executingUser);
    const isExecutorAdmin = await this.isUserAdministrators(executingUser, executingUser);

    if(!isExecutorAdmin && (existingUser.id !== executingUser.id)) {
      throw new Error(`User ${executingUser.login} can't update ${usertoUpdate.login}. Not same user and has not role administrators`);
    }

    if(!usertoUpdate.isActive && usertoUpdate.isActive !== false)
      usertoUpdate.isActive = existingUser.isActive;

    if(isExecutorAdmin){
      if(existingUser.id !== usertoUpdate.id ||
        existingUser.login !== usertoUpdate.login){
        throw new Error('Only active state or password can be updated for user by administrators.')
      }
      if(executingUser.id === usertoUpdate.id && !usertoUpdate.isActive){
        throw new Error('Administrator can\'t deactivate himself.')
      }
    } else {
      if(existingUser.id !== usertoUpdate.id ||
        existingUser.login !== usertoUpdate.login ||
        existingUser.isActive !== usertoUpdate.isActive
      ) {
        throw new Error('Only password can be updated for active user.')
      }
      UserEntityRules.validatePassword(usertoUpdate.password);
    }
    return await this.storage.update(usertoUpdate);
  }

  async delete(id: number | string, executingUser:User): Promise<User> {
    const usableId = UserEntityRules.convertId(id);
    if(!usableId || typeof usableId !== 'number')
      throw new Error('Please provide a correct id for delete.')
    return await this.storage.delete(usableId)
  }

  async getMetadata(user:User, metadataKeyOrId:string | number, executingUser:User):Promise<Metadata> {
    const filter:any = {
      ownerType:'user',
      ownerId:user.id
    }
    const metadataUseCase:MetadataUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Metadata');
    if(isNumber(metadataKeyOrId)){
      const metadata:Metadata = await metadataUseCase.get(metadataKeyOrId, executingUser);
      if(metadata.ownerType === 'user' && metadata.ownerId === filter.ownerId) {
        return metadata;
      }
    } else {
      filter.key = metadataKeyOrId.toString();
      const found:Metadata[] = await metadataUseCase.find(filter, executingUser);
      if(Array.isArray(found) && found.length > 0){
        return found[0];
      } else {
        return await this.createMetadata(user, {
          key: metadataKeyOrId.toString(),
          ownerId: user.id,
          ownerType: 'user',
          isPublic: false,
          value:''
        }, executingUser);
      }
    }
    throw new Error(`No metadata with key ${metadataKeyOrId} exists for user with id ${user.id}`);
  }

  async createMetadata(user: User, data: Metadata, executingUser:User) {
    const metadataUseCase = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Metadata');
    UserEntityRules.validateMetadata(user, data);
    return await metadataUseCase.create(data);
  }

  async updateMetadata(user: User, data: Metadata, executingUser:User) {
    const metadataUseCase:MetadataUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Metadata');
    UserEntityRules.validateMetadata(user, data);
    return await metadataUseCase.update(data.key, data, executingUser);
  }

  async hasRole(user: User, role: Role, executingUser:User):Promise<boolean> {
    let rolesMetadata:Metadata
    try {
      rolesMetadata = await this.getMetadata(user,'roles', executingUser);
    }catch(err) {
      rolesMetadata = await this.createMetadata(user, {
        key:'roles',
        value:[]
      }, executingUser);
    }
    return Array.isArray(rolesMetadata.value) &&
      rolesMetadata.value.length >= 1 &&
      rolesMetadata.value.indexOf(role.id) >= 0
  }

  async getRoles(user: User, executingUser:User) {
    let rolesMetadata:Metadata;
    try {
      rolesMetadata = await this.getMetadata(user,'roles',executingUser);
    }catch(err) {
      rolesMetadata = await this.createMetadata(user, {
        key:'roles',
        value:[]
      },executingUser)
    }
    if(!Array.isArray(rolesMetadata.value) ||
      rolesMetadata.value.length <= 0
    )
      return [];
    const roleUseCases:RoleUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Role');
    const roles:Role[] = [];
    for(const roleId of rolesMetadata.value) {
      roles.push(await roleUseCases.get(roleId, executingUser))
    }
    return roles;
  }

  async addRole(user: User, role: Role, executingUser:User) {
    const hasRole = await this.hasRole(user,role, executingUser)
    if(!hasRole){
      const rolesMetadata:Metadata = await this.getMetadata(user,'roles', executingUser);
      if(!Array.isArray(rolesMetadata.value)){
        rolesMetadata.value = [];
      }
      rolesMetadata.value.push(role.id);
      await this.updateMetadata(user,rolesMetadata, executingUser);
    }
  }

  async removeRole(user: User, role: Role, executingUser:User) {
    const hasRole = await this.hasRole(user,role,executingUser)
    if(hasRole){
      const rolesMetadata:Metadata = await this.getMetadata(user,'roles', executingUser);
      rolesMetadata.value.splice(rolesMetadata.value.indexOf(role.id),1);
      await this.updateMetadata(user,rolesMetadata, executingUser);
    }
  }

  async isUserAuthorized(user: User, filter: Authorization, executingUser:User) : Promise<boolean> {
    const userRoles = await this.getRoles(user,executingUser)
    for(const role of userRoles){
       const authorizationUseCase:AuthorizationUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Authorization');
       try{
         const authorizations = await authorizationUseCase.find({
           ...filter,
           ...{ role:role.id}
         }, executingUser)
         if(authorizations.length > 0){
           return true;
         }
       }catch(err) {
         console.error(err);
         const authorizations = await authorizationUseCase.find({
         ...filter,
         ...{ role:role.id}
       }, executingUser)
       if(authorizations.length > 0){
         return true;
       }
         throw err;
       }
    }
    return false;
  }

  async isDataAuthorized(data:Entity, right:string='r', user?:any):Promise<boolean> {
    if(await this.isUserAdministrators(user, user) || await this.isSpecialUser(user, user))
      return true;
    return super.isDataAuthorized(data,right,user);
  }

  secureUserForExternal(user:User):Partial<User> {
    delete user.password
    return user;
  }

  async isMemberOf(roleName:string, user:User, executingUser:User):Promise<boolean>{
    const roleUseCases:RoleUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Role');
    const role:Role = await roleUseCases.get(roleName, executingUser);
    return this.hasRole(user, role, executingUser);
  }

  async isUserAdministrators(user:User, executingUser:User):Promise<boolean> {
    return await this.isMemberOf('administrators', user, executingUser);
  }

  async isSpecialUser(user:User, executingUser:User):Promise<boolean> {
    return await this.isMemberOf('specialUsers', user, executingUser);
  }
}
