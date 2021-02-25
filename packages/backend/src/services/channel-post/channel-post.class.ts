import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {UserUseCases} from "../../usecases/UserUseCases";
import {MetadataUseCases} from "../../usecases/MetadataUseCases";
import {BaseService, BaseServiceConfiguration} from "../BaseService";
import {ChannelPost as ChannelPostEntity} from '../../entities/ChannelPost'
import {ChannelUseCases} from "../../usecases/ChannelUseCases";
import {ChannelPostUseCases} from "../../usecases/ChannelPostUseCases";
import {NotAuthenticated, NotFound, NotImplemented} from "@feathersjs/errors";
import {globalInstancesFactory} from "@hermes/composition";
import {Channel, ChannelVisibility} from "../../entities/Channel";
import {User} from "../../entities/User";
import {TopicMessage, TopicService, TopicServiceConfiguration} from "@hermes/topicservice";
import {Logger} from "../../plugins/Logging/Logger";
import {NotAuthorizedError} from "../../entities/Errors/NotAuthorizedError";

type Data = ChannelPostEntity

interface ServiceOptions extends BaseServiceConfiguration {
  paginate?:number
  storage: {
    contractName:string;
    configuration?:any
  },
  topicService:{
    contractName:string
    configuration?:any
  }
}

export class ChannelPost extends BaseService<Data, ChannelPostUseCases> {

  app: Application;
  options: ServiceOptions;
  private userUseCases: UserUseCases;
  private channelUseCases: ChannelUseCases;
  private topicService: TopicService;
  private logger: Logger;

  constructor (options: ServiceOptions = {
    storage: { contractName: 'Default'},
    topicService: { contractName: 'Default'}
  }, app: Application) {
    super(app, 'channel-posts','ChannelPost', options);
    this.options = options;
    this.app = app;
    this.logger = globalInstancesFactory.getInstanceFromCatalogs('Logger', app.get('logger').contractName, app.get('logger').configuration);
    this.userUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','User');
    this.channelUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'Channel');
    this.topicService = globalInstancesFactory.getInstanceFromCatalogs('TopicService', options.topicService.contractName, TopicServiceConfiguration.load(options.topicService.configuration));
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<Data[] | Paginated<Data>> {
    if(params && params.user && params.route && params.route.channelNameOrId) {
      const channel:Channel = await this.channelUseCases.get(params.route.channelNameOrId.toString(), params.user as User);
      let filter:Partial<ChannelPostEntity> = params.query as ChannelPostEntity;
      if(channel){
        if(!filter || !filter.channelKey || filter.channelKey !== channel.key){
          console.log('default filter for post in channel')
          if(!filter)
            filter = {
              channelKey:channel.key,
              parentPost:undefined
            }
          if(filter) {
            filter.channelKey = channel.key
          }
        } else {
          console.log('the filter :');
          console.log(filter);
        }

        const found = await this.useCase.find(filter, params.user as User, channel.key);
        return found;
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
      const post = await this.useCase.create(data, params.user as User, channel.key);
      this.topicService.publish(`channels.${channel.key}.posts`, new TopicMessage(
        post,
        (params.user as User).login
      )).catch((error) => {
        console.log(error);
      })
      return post;
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
          throw new NotAuthorizedError(`User ${user.login} is not a member or has not sufficient rights to execute ${context.method} on channel ${channel.key}`)
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
