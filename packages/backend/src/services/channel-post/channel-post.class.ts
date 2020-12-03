import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {UserUseCases} from "../../usecases/UserUseCases";
import {MetadataUseCases} from "../../usecases/MetadataUseCases";
import {BaseService} from "../BaseService";
import {ChannelPost as ChannelPostEntity} from '../../entities/ChannelPost'
import {ChannelUseCases} from "../../usecases/ChannelUseCases";
import {ChannelPostUseCases} from "../../usecases/ChannelPostUseCases";
import {NotAuthenticated, NotFound, NotImplemented} from "@feathersjs/errors";
import {globalInstancesFactory} from "@hermes/composition";
import {Channel, ChannelVisibility} from "../../entities/Channel";
import {User} from "../../entities/User";

type Data = ChannelPostEntity

interface ServiceOptions {
  paginate?:number
  storage: {
    contractName:string;
    configuration?:any
  }
  topicService:{
    contractName:string
    configuration?:any
  }
}

export class ChannelPost extends BaseService<Data> {

  app: Application;
  options: ServiceOptions;
  private userUseCases: UserUseCases;
  private channelUseCases: ChannelUseCases;
  private useCase: ChannelPostUseCases;

  constructor (options: ServiceOptions = {
    storage: { contractName: 'Default'},
    topicService: { contractName: 'Default'}
  }, app: Application) {
    super(app, 'channel-posts');
    this.options = options;
    this.app = app;
    this.userUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','User');
    this.channelUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'Channel');
    this.useCase = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'ChannelPost', options);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<Data[] | Paginated<Data>> {
    if(params && params.user && params.route && params.route.channelNameOrId) {
      const channel:Channel = await this.channelUseCases.get(params.route.channelNameOrId.toString(), params.user as User);
      let filter:Partial<ChannelPostEntity> = params.query as ChannelPostEntity;
      if(channel){
        if(!filter){
          filter = {
            channelKey:channel.key
          }
        }
        return await this.useCase.find(filter, params.user as User, channel.key);
      }
    }
    return [];
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<Data> {
    const paramAsAny = params as any;
    const channelName:string = '';
    if(paramAsAny && paramAsAny.route && paramAsAny.route.channelNameOrId)
    {
      const channel:Channel = await this.channelUseCases.get(paramAsAny.route.channelNameOrId.toString(), paramAsAny.user as User);
      return await this.useCase.get(id, paramAsAny.user as User, channel.key)
    }
    if(paramAsAny && paramAsAny.route && paramAsAny.route.channelKeyOrId)
      throw new NotFound(`No post with id ${id} in channel ${paramAsAny.route.channelNameOrId}`)
    throw new NotFound(`No post with id ${id}`);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async create (data: Data, params?: Params): Promise<Data> {
    if(params && params.route && params.route.channelNameOrId){
      const channel:Channel = await this.channelUseCases.get(params.route.channelNameOrId.toString(), params.user as User);
      return await this.useCase.create(data, params.user as User, channel.key);
    }
    throw new NotAuthenticated('User not authenticated');
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: Data, params?: Params): Promise<Data> {
    throw new NotImplemented()
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async patch (id: NullableId, data: Data, params?: Params): Promise<Data> {
    throw new NotImplemented()
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async remove (id: NullableId, params?: Params): Promise<Data> {
    throw new NotImplemented()
  }

  async needAuthentication(context: any): Promise<boolean> {
    return true;
  }

  async isAuthorized(context:any):Promise<boolean>{
    let isAuthorized = false;
    if(await super.isAuthorized(context)){
      const params:any = context.params;
      if(params &&
        params.route &&
        params.route.channelNameOrId &&
        params.user as User
      ){
        const channel:Channel = await this.channelUseCases.get(params.route.channelNameOrId.toString(), params.user as User);
        const user:User = params.user as User
        switch(context.method){
          case 'create':
            isAuthorized = await this.channelUseCases.isUserContributor(channel, user, user);
            break;
          case 'get':
          case 'find':
            isAuthorized = await this.channelUseCases.isUserReader(channel, user, user)
            break;
          case 'update':
          case 'patch':
          case 'remove': {
            if(await this.channelUseCases.isUserEditor(channel, user, user)){
              isAuthorized = true;
            }else if(await this.channelUseCases.isUserContributor(channel, user, user)){
              if(params.route.id){
                const post = await this.get(params.route.id, params)
                isAuthorized = await this.useCase.isDataAuthorized(post, 'w', params.user)
              }
            }
          }
        }
        if(!isAuthorized){
          throw new Error(`User ${user.login} is not a member or has not sufficient rights to execute ${context.Method} on channel ${channel.key}`)
        }
      }
    }
    return isAuthorized;
  }

  async isDataAuthorized(data: ChannelPostEntity, right: string, user?: User): Promise<boolean> {
    if(!user)
      throw new NotAuthenticated('User is not authenticated');
    return await this.useCase.isDataAuthorized(data, right, user);
  }

}
