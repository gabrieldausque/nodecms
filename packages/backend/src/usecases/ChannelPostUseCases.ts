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
import {UserUseCases} from "./UserUseCases";

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
    entity.creationDate = new Date();
    if(entity.channelKey !== channelKey){
      entity.channelKey = channelKey
    }
    ChannelPostRules.validate(entity);
    const created = await this.channelPostStorage.create(entity, entity.channelKey);
    if(isNumber(created.id) && typeof created.id === 'number')
      return await this.get(created.id, executingUser, channelKey);
    throw new Error('No id for created post');
  }

  async delete(id: string | number, executingUser: User): Promise<ChannelPost> {
    throw new Error('Not implemented');
  }

  async find(filter: Partial<ChannelPost>, lastIndex?:number | string, executingUser?: User, channelName?:string): Promise<ChannelPost[]> {
    ChannelPostRules.validateFilter(filter);
    if(filter && channelName){
      filter.channelKey = (filter.channelKey && filter.channelKey === channelName)?
        filter.channelKey:
        channelName
      const found =  await this.channelPostStorage.find(filter,lastIndex, filter.channelKey);
      for(const p of found){
        if(typeof p.author === 'number') {
          const userUseCases:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'User');
          p.author = userUseCases.secureUserForExternal(await userUseCases.get(p.author, executingUser));
        }
      }
      return found;
    }
    return [];
  }

  async get(id: string | number, executingUser: User | undefined, channelName?:string): Promise<ChannelPost> {
    const usableId = ChannelPostRules.convertId(id);
    const p = await this.channelPostStorage.get(usableId, channelName);
    if(typeof p.author === 'number') {
      const userUseCases:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'User');
      p.author = userUseCases.secureUserForExternal(await userUseCases.get(p.author, executingUser));
    }
    return p;
  }

  async update(id: string | number, entityToUpdate: ChannelPost, executingUser: User): Promise<ChannelPost> {
    throw new Error('Not implemented');
  }

  async isDataAuthorized(data: ChannelPost, right: string = 'r', user?: any): Promise<boolean> {
    if(data.channelKey &&
      user &&
      typeof user.id === 'number'
    ){
      if(typeof data.author === 'number' && data.author === user.id){
        return true;
      } else {
        if(right === 'w'){
          const channelUseCases:ChannelUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Channel');
          const channel:Channel = await channelUseCases.get(data.channelKey, user);
          if(await channelUseCases.isUserContributor(channel, user, user)){
            return true;
          }
        }else if(right === 'r'){
          const channelUseCases:ChannelUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Channel');
          const channel:Channel = await channelUseCases.get(data.channelKey, user);
          if(await channelUseCases.isUserReader(channel, user, user)){
            return true;
          }
        }

      }
    }

    return super.isDataAuthorized(data, right, user);
  }
}
