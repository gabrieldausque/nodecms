import {globalInstancesFactory} from "@hermes/composition";
import {UserStorage} from '../plugins/Storages/User/UserStorage';
import {EntityRules, EntityRulesFactory, MetadataEntityRules, UserEntityRules} from "@nodecms/backend-data-rules";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {UseCases} from "./UseCases";
import {MetadataUseCases} from "./MetadataUseCases";
import {isNumber} from "@nodecms/backend-data";
import {RoleUseCases} from "./RoleUseCases";
import {AuthorizationUseCases} from "./AuthorizationUseCases";
import {Metadata} from "@nodecms/backend-data";
import {Authorization} from "@nodecms/backend-data";
import {Role} from "@nodecms/backend-data";
import {User} from "@nodecms/backend-data";
import {Entity} from "@nodecms/backend-data";

export interface UserUseCasesConfiguration extends UseCaseConfiguration {

}

export class UserUseCases extends UseCases<User, UserEntityRules> {

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
    super('user',
      'UserStorage',
      configuration,
      false,
      UserEntityRules);
  }

  validate(data: any): User {
    if(data.id) {
      data.id = this.entityRules.convertId(data.id);
    }

    if(data.login) {
      this.entityRules.validateLogin(data.login)
    }

    if(data.password) {
      this.entityRules.validatePassword(data.password);
    }

    return data;
  }

  async create(user:Partial<User>, executingUser:User): Promise<User> {
    this.entityRules.validatePassword(user.password);
    this.entityRules.validateLogin(user.login);
    if(user.login && await this.storage.exists(user.login))
      throw new Error(`Login ${user.login} already exists. Please change.`)
    const created = await this.storage.create(user);
    const roleUseCase = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Role');
    await this.addRole(created, await roleUseCase.get('users'), executingUser);
    return created;
  }

  async get(idOrLogin: string | number, executingUser?:User) : Promise<User> {
    if(this.entityRules.validateId(idOrLogin)) {
      const id = this.entityRules.convertId(idOrLogin);
      return await this.storage.get(id);
    }
    return await this.storage.get(idOrLogin);
  }

  //TODO : create a usecase where only admin users can update the active state
  async update(id: number | string, usertoUpdate: User, executingUser:User) : Promise<User> {
    const usableId = this.entityRules.convertId(id);
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
      this.entityRules.validatePassword(usertoUpdate.password);
    }
    return await this.storage.update(usertoUpdate);
  }

  async delete(id: number | string, executingUser:User): Promise<User> {
    const usableId = this.entityRules.convertId(id);
    if(typeof usableId !== 'number')
      throw new Error('Please provide a correct id for delete.')
    return await this.storage.delete(usableId)
  }

  async getMetadata(user:Partial<User>, metadataKeyOrId:string | number, executingUser:User):Promise<Metadata> {
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
      const found:Metadata[] = await metadataUseCase.find(filter, undefined, executingUser);
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

  async createMetadata(user: Partial<User>, data: Partial<Metadata>, executingUser:User) {
    const metadataUseCase = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Metadata');
    this.entityRules.validateMetadata(user, data);
    return await metadataUseCase.create(data);
  }

  async updateMetadata(user: User, data: Metadata, executingUser:User) {
    const metadataUseCase:MetadataUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Metadata');
    this.entityRules.validateMetadata(user, data);
    return await metadataUseCase.update(data.key, data, executingUser);
  }

  async hasRole(user: Partial<User>, role: Role, executingUser?:User):Promise<boolean> {
    return Array.isArray(role.members) &&
      typeof user.id === 'number' &&
      role.members.indexOf(user.id) >= 0;
  }

  async getRoles(user: Partial<User>, executingUser:User) {
    const roleUseCases:RoleUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Role');
    if(typeof user.id === 'number'){
      return await roleUseCases.find({
        members:[user.id]
      }, undefined, executingUser);
    }
    return [];
  }

  async addRole(user: User, role: Role, executingUser:User) {
    const hasRole = await this.hasRole(user,role, executingUser)
    if(!hasRole){
      const roleUseCases:RoleUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Role');
      await roleUseCases.addMember(role, user, executingUser);
    }
  }

  async removeRole(user: User, role: Role, executingUser:User) {
    const hasRole = await this.hasRole(user,role,executingUser)
    if(hasRole){
      const roleUseCases:RoleUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Role');
      await roleUseCases.removeMember(role, user, executingUser);
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
         }, undefined, executingUser)
         if(authorizations.length > 0){
           return true;
         }
       }catch(err) {
         console.error(err);
         const authorizations = await authorizationUseCase.find({
         ...filter,
         ...{ role:role.id}
       },undefined, executingUser)
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
    user.password = "***";
    return user;
  }

  async isMemberOf(roleName:string, user:User, executingUser:User):Promise<boolean>{
    if(user) {
      const roleUseCases:RoleUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Role');
      const role:Role = await roleUseCases.get(roleName, executingUser);
      return this.hasRole(user, role, executingUser);
    }
    return false;
  }

  async isUserAdministrators(user:User, executingUser:User):Promise<boolean> {
    return await this.isMemberOf('administrators', user, executingUser);
  }

  async isSpecialUser(user:User, executingUser:User):Promise<boolean> {
    return await this.isMemberOf('specialUsers', user, executingUser);
  }

  async isValidUser(user: Partial<User>, executingUser?: User):Promise<boolean> {
    if(user && (user.id || user.id === 0)){
      const currentUser = await this.get(user.id);
      const roleUseCases:RoleUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'Role');
      const userRole = await roleUseCases.get('users', executingUser);
      const specialUserRole = await roleUseCases.get('specialUsers', executingUser);
      const adminRole = await roleUseCases.get('administrators', executingUser);
      const hasMinimumRoles = await this.hasRole(user, userRole, executingUser) ||
                              await this.hasRole(user, specialUserRole, executingUser) ||
                              await this.hasRole(user, adminRole, executingUser);
      const isActive = (currentUser.isActive)?currentUser.isActive:false;
      return currentUser && isActive && hasMinimumRoles;
    }
    return false;
  }
}
