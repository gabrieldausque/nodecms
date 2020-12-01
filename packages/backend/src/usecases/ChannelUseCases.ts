import {UseCases} from "./UseCases";
import {Channel} from "../entities/Channel";
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

  async create(entity: Channel, executingUser: User): Promise<Channel> {
      ChannelRules.validate(entity);
      const usableId = ChannelRules.convertId(executingUser.id);
      entity.administrators?.push(usableId);
      return await this.storage.create(entity);
  }

  async delete(id: string | number, executingUser: User): Promise<Channel> {
    throw new Error('not implemented');
  }

  async find(filter: Channel, executingUser: User | undefined): Promise<Channel[]> {
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

  async update(id: string | number, entityToUpdate: Channel, executingUser: User): Promise<Channel> {
    throw new Error('not implemented');
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
    if(channel.readers && user.id){
      return channel.readers.indexOf(user.id) >= 0 ||
        await this.isUserContributor(channel, user, user) ||
        await this.isUserEditor(channel, user, user) ||
        await this.isUserAdministrator(channel, user, user)
    }
    return false;
  }

  async isUserContributor(channel:Channel, user:User, executingUser:User):Promise<boolean>{
    if(channel.contributors && user.id){
      return channel.contributors.indexOf(user.id) >= 0 ||
        await this.isUserEditor(channel, user, user)
    }
    return false;
  }

  async isUserEditor(channel:Channel, user:User, executingUser:User):Promise<boolean>{
    if(channel.editors && user.id){
      return channel.editors.indexOf(user.id) >= 0 ||
        await this.isUserAdministrator(channel, user, user)
    }
    return false;
  }

  async isUserAdministrator(channel:Channel, user:User, executingUser:User):Promise<boolean>{
    if(channel.administrators && user.id){
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
