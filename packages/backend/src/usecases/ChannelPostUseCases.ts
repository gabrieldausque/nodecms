import {UseCases} from "./UseCases";
import {ChannelPost} from "../entities/ChannelPost";
import {User} from "../entities/User";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {ChannelPostStorage} from "../plugins/Storages/Channel/ChannelPostStorage";
import {isNumber} from "../helpers";
import {ChannelPostRules} from "../entities/ChannelPostRules";
import {ChannelUseCases} from "./ChannelUseCases";
import {globalInstancesFactory} from "@hermes/composition";
import {Channel} from "../entities/Channel";

interface ChannelPostUseCasesConfiguration extends UseCaseConfiguration {
}

export class ChannelPostUseCases extends UseCases<ChannelPost> {

  public static metadata:any[] = [
    {
      contractType:'UseCases',
      contractName:'ChannelPost',
      isShared:true
    }
  ]

  channelPostStorage:ChannelPostStorage;

  constructor(configuration:ChannelPostUseCasesConfiguration) {
    super('channelPost','ChannelPostStorage', configuration);
    this.channelPostStorage = this.storage as ChannelPostStorage;
  }

  async create(entity: ChannelPost, executingUser: User, channelKey?:string): Promise<ChannelPost> {
    entity.author = executingUser.id;
    if(entity.channelKey !== channelKey){
      entity.channelKey = channelKey
    }
    ChannelPostRules.validate(entity);
    const created = await this.channelPostStorage.create(entity, entity.channelKey);
    if(isNumber(created.id) && typeof created.id === 'number')
      return this.channelPostStorage.get(created.id, created.channelKey)
    throw new Error('No id for created post');
  }

  async delete(id: string | number, executingUser: User): Promise<ChannelPost> {
    throw new Error('Not implemented');
  }

  async find(filter: Partial<ChannelPost>, executingUser: User | undefined, channelName?:string): Promise<ChannelPost[]> {
    if(filter && channelName){
      filter.channelKey = (filter.channelKey && filter.channelKey === channelName)?
        filter.channelKey:
        channelName
      return await this.channelPostStorage.find(filter, filter.channelKey);
    }
    return [];
  }

  async get(id: string | number, executingUser: User | undefined, channelName?:string): Promise<ChannelPost> {
    const usableId = ChannelPostRules.convertId(id);
    return await this.channelPostStorage.get(usableId, channelName)
  }

  async update(id: string | number, entityToUpdate: ChannelPost, executingUser: User): Promise<ChannelPost> {
    throw new Error('Not implemented');
  }

  async isDataAuthorized(data: ChannelPost, right: string = 'r', user?: any): Promise<boolean> {
    if(right === 'w' &&
      typeof data.author === 'number' &&
      data.channelKey &&
      user &&
      typeof user.id === 'number'
    ){
      if(data.author === user.id){
        return true;
      } else {
        const channelUseCases:ChannelUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Channel');
        const channel:Channel = await channelUseCases.get(data.channelKey, user);
        if(await channelUseCases.isUserEditor(channel, user, user)){
          return true;
        }
      }
    }

    return super.isDataAuthorized(data, right, user);
  }
}
