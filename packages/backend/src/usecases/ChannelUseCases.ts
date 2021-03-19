import {UseCases} from "./UseCases";
import {Channel as ChannelEntity, Channel, ChannelVisibility} from "../entities/Channel";
import {User} from "../entities/User";
import {isNumber} from "../helpers";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {globalInstancesFactory} from "@hermes/composition";
import {UserUseCases} from "./UserUseCases";
import {ChannelRules} from "../entities/ChannelRules";
import {Entity} from "../entities/Entity";
import {RoleUseCases} from "./RoleUseCases";

interface ChannelUseCasesConfiguration extends UseCaseConfiguration {};

export class ChannelUseCases extends UseCases<Channel> {

  public static metadata:any[] = [
    {
      contractType:'UseCases',
      contractName:'Channel',
      isShared:true
    }
  ]

  constructor(configuration:ChannelUseCasesConfiguration) {
    super('channel', 'ChannelStorage', configuration);
  }

  async create(entity: Partial<Channel>, executingUser: User): Promise<Channel> {
      ChannelRules.validate(entity);
      if(entity.key && await this.storage.exists(entity.key))
        throw new Error(`Channel with key ${entity.key} already exists`)
      const usableId = ChannelRules.convertId(executingUser.id);
      const roleUseCases:RoleUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'Role');
      const userUseCases:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','User');
      const readers = await roleUseCases.create({
        key:`channel-${entity.key}-readers`,
        description: `Readers for channel ${entity.key}`
      }, executingUser);
      const contributors = await roleUseCases.create({
        key:`channel-${entity.key}-contributors`,
        description: `Contributors for channel ${entity.key}`
      }, executingUser)
      const editors = await roleUseCases.create({
        key:`channel-${entity.key}-editors`,
        description: `Editors for channel ${entity.key}`
      }, executingUser)
      const adminRoles = await roleUseCases.create({
        key:`channel-${entity.key}-administrators`,
        description: `Administrators for channel ${entity.key}`,
        members:[usableId]
      }, executingUser)
      await userUseCases.addRole(executingUser,adminRoles,executingUser)
      if(Array.isArray(entity.administrators) && typeof adminRoles.id === 'number')
        entity.administrators.push(adminRoles.id)
      if(Array.isArray(entity.editors) && typeof editors.id === 'number')
        entity.editors.push(editors.id)
      if(Array.isArray(entity.contributors) && typeof contributors.id === 'number')
        entity.contributors.push(contributors.id)
      if(Array.isArray(entity.readers) && typeof readers.id === 'number')
        entity.readers.push(readers.id)
      const createdChannel = await this.storage.create(entity);
      return createdChannel;
  }

  async delete(id: string | number, executingUser: User): Promise<Channel> {
    let channel:Channel|null = null;
    if(isNumber(id)){
      const usableId:number = parseInt(id.toString());
      channel = await this.get(usableId, executingUser);
    } else if(typeof id === 'string') {
      const found = await this.find({
        key: id
      }, undefined,executingUser);
      if(Array.isArray(found) && found.length > 0){
        channel = found[0];
      }
    }
    if(channel && typeof channel.id === 'number')
      return await this.storage.delete(channel.id);
    throw new Error(`Channel with id or key ${id} doesn't exists.`)
  }

  async find(filter: Partial<Channel>, lastIndex?:number, executingUser?: User): Promise<Channel[]> {
    const found = await this.storage.find(filter, lastIndex);
    found.map(c => {
      ChannelRules.validate(c)
    })
    return found;
  }

  async get(id: string | number, executingUser: User | undefined): Promise<Channel> {
    let channel:Channel | null = null;
     channel = await this.storage.get(id);
     if(channel){
       ChannelRules.validate(channel);
     }
     return channel;
  }

  async update(id: string | number, entityToUpdate: Partial<Channel>, executingUser: User): Promise<Channel> {
    const existing:Channel = await this.get(id,executingUser);
    if(
      (typeof entityToUpdate.id === 'number' && existing.id != entityToUpdate.id) ||
      (typeof entityToUpdate.key === 'string' && existing.key != entityToUpdate.key)
    )
      throw new Error('Only label and visibility can be changed or you can only add members from this service ' +
        'API')

    if(entityToUpdate.label){
      existing.label = entityToUpdate.label;
    }

    if(ChannelRules.isAuthorizedVisibility(entityToUpdate.visibility) &&
      typeof entityToUpdate.visibility === 'string'){
      existing.visibility = entityToUpdate.visibility;
    }

    if(Array.isArray(entityToUpdate.readers) &&
      Array.isArray(existing.readers) &&
      await this.isUserEditor(existing,executingUser,executingUser)){
      for(const userId of entityToUpdate.readers){
        if(existing.readers.indexOf(userId) < 0){
          existing.readers.push(userId);
        }
      }
    }

    if(Array.isArray(entityToUpdate.contributors) &&
      Array.isArray(existing.contributors) &&
      await this.isUserEditor(existing,executingUser,executingUser)){
      for(const userId of entityToUpdate.contributors){
        if(existing.contributors.indexOf(userId) < 0){
          existing.contributors.push(userId);
        }
      }
    }

    if(Array.isArray(entityToUpdate.editors) &&
      Array.isArray(existing.editors) &&
      await this.isUserAdministrator(existing,executingUser,executingUser)){
      for(const userId of entityToUpdate.editors){
        if(existing.editors.indexOf(userId) < 0){
          existing.editors.push(userId);
        }
      }
    }

    if(Array.isArray(entityToUpdate.administrators) &&
      Array.isArray(existing.administrators) &&
      await this.isUserAdministrator(existing,executingUser,executingUser)){
      for(const userId of entityToUpdate.administrators){
        if(existing.administrators.indexOf(userId) < 0){
          existing.administrators.push(userId);
        }
      }
    }

    return await this.storage.update(existing);
  }

  async isUserMemberOf(channel:Channel, user:User, executingUser:User):Promise<boolean>{
    if(user &&
      typeof user.id === 'number' &&
      isNumber(user.id)){
      const usableId:number = parseInt(user.id.toString())
      return await this.isUserReader(channel, user, executingUser)||
      await this.isUserContributor(channel, user, executingUser) ||
      await this.isUserEditor(channel, user, executingUser) ||
      await this.isUserAdministrator(channel, user, executingUser);
    }
    return false
  }

  async isUserReader(channel:Channel, user:User, executingUser:User):Promise<boolean>{
    let isUserReader = channel.visibility === ChannelVisibility.public;
    if(!isUserReader && channel.readers && typeof user.id === 'number' && !isUserReader){
        const roleUseCases:RoleUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'Role');
        const userUseCases:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'User');
        for(const readerRoleId of channel.readers){
          const role = await roleUseCases.get(readerRoleId, user);
          isUserReader = await userUseCases.isMemberOf(role.key, user, executingUser);
          if(isUserReader)
            break;
        }
        if(!isUserReader){
          isUserReader = await this.isUserContributor(channel, user, user)
        }
    }
    return isUserReader;
  }

  async isUserContributor(channel:Channel, user:User, executingUser:User):Promise<boolean>{
    let isUserContributor = channel.visibility === ChannelVisibility.public;
    if(!isUserContributor && channel.contributors && typeof user.id === 'number'){
      const roleUseCases:RoleUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'Role');
      const userUseCases:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'User');
      for(const contributorRoleId of channel.contributors){
        const role = await roleUseCases.get(contributorRoleId, user);
        isUserContributor = await userUseCases.isMemberOf(role.key, user, executingUser);
        if(isUserContributor)
          break;
      }
      if(!isUserContributor){
        isUserContributor = await this.isUserEditor(channel, user, user)
      }
    }
    return isUserContributor;
  }

  async isUserEditor(channel:Channel, user:User, executingUser:User):Promise<boolean>{
    let isUserEditor = false;
    if(channel.editors && typeof user.id === 'number'){
      const roleUseCases:RoleUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'Role');
      const userUseCases:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'User');
      for(const contributorRoleId of channel.editors){
        const role = await roleUseCases.get(contributorRoleId, user);
        isUserEditor = await userUseCases.isMemberOf(role.key, user, executingUser);
        if(isUserEditor)
          break;
      }
      if(!isUserEditor){
        isUserEditor = await this.isUserAdministrator(channel, user, user)
      }
    }
    return isUserEditor;
  }

  async isUserAdministrator(channel:Channel, user:User, executingUser:User):Promise<boolean>{
    let isUserAdministrators = false;
    if(channel.administrators && typeof user.id === 'number'){
      const roleUseCases:RoleUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'Role');
      const userUseCases:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'User');
      for(const contributorRoleId of channel.administrators){
        const role = await roleUseCases.get(contributorRoleId, user);
        isUserAdministrators = await userUseCases.isMemberOf(role.key, user, executingUser);
        if(isUserAdministrators)
          break;
      }
      if(!isUserAdministrators){
        isUserAdministrators = await userUseCases.isUserAdministrators(user,executingUser);
      }
    }
    return isUserAdministrators;
  }

  async isDataAuthorized(data:Channel, right:string='r', user?:any):Promise<boolean> {
    let isAuthorized = false;
    const u:User = user as User;
    const userUseCase:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'User');
    if(right === 'r'){
      if(data.visibility === ChannelVisibility.public || data.visibility === ChannelVisibility.protected)
      {
        isAuthorized = await userUseCase.isValidUser(u,u);
      } else {
        isAuthorized = await this.isUserMemberOf(data,u, u);
      }
    } else if (right === 'w'){
      isAuthorized = await this.isUserContributor(data as ChannelEntity, u, u);
    }
    //TODO : add service channel-roles !!!
    data.isContributor = await this.isUserContributor(data as ChannelEntity, u, u);
    return isAuthorized;
  }

}
