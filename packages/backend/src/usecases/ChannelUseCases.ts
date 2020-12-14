import {UseCases} from "./UseCases";
import {Channel, ChannelVisibility} from "../entities/Channel";
import {User} from "../entities/User";
import {isNumber} from "../helpers";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {globalInstancesFactory} from "@hermes/composition";
import {UserUseCases} from "./UserUseCases";
import {ChannelRules} from "../entities/ChannelRules";

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
      entity.administrators?.push(usableId);
      return await this.storage.create(entity);
  }

  async delete(id: string | number, executingUser: User): Promise<Channel> {
    let channel:Channel|null = null;
    if(isNumber(id)){
      const usableId:number = parseInt(id.toString());
      channel = await this.get(usableId, executingUser);
    } else if(typeof id === 'string') {
      const found = await this.find({
        key: id
      }, executingUser);
      if(Array.isArray(found) && found.length > 0){
        channel = found[0];
      }
    }
    if(channel && typeof channel.id === 'number')
      return await this.storage.delete(channel.id);
    throw new Error(`Channel with id or key ${id} doesn't exists.`)
  }

  async find(filter: Partial<Channel>, executingUser: User | undefined): Promise<Channel[]> {
    const found = await this.storage.find(filter);
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
    if(channel.readers && typeof user.id === 'number'){
      return channel.visibility === ChannelVisibility.public ||
        channel.readers.indexOf(user.id) >= 0 ||
        await this.isUserContributor(channel, user, user)
    }
    return false;
  }

  async isUserContributor(channel:Channel, user:User, executingUser:User):Promise<boolean>{
    if(channel.contributors && typeof user.id === 'number'){
      return channel.visibility === ChannelVisibility.public ||
        channel.contributors.indexOf(user.id) >= 0 ||
        await this.isUserEditor(channel, user, user)
    }
    return false;
  }

  async isUserEditor(channel:Channel, user:User, executingUser:User):Promise<boolean>{
    if(channel.editors && typeof user.id === 'number'){
      return channel.editors.indexOf(user.id) >= 0 ||
        await this.isUserAdministrator(channel, user, user)
    }
    return false;
  }

  async isUserAdministrator(channel:Channel, user:User, executingUser:User):Promise<boolean>{
    if(channel.administrators && typeof user.id === 'number'){
      if(channel.administrators.indexOf(user.id) >= 0)
        return true;
      else
      {
        const userUseCases:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases',
          'User');
        return await userUseCases.isUserAdministrators(user, executingUser);
      }
    }
    return false;
  }

}
