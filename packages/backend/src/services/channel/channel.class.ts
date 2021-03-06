import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {Channel as ChannelEntity, ChannelVisibility} from '@nodecms/backend-data'
import {BaseService, BaseServiceConfiguration} from "../BaseService";
import {NotAcceptable, NotAuthenticated, NotFound, NotImplemented} from "@feathersjs/errors";
import {ChannelUseCases} from "../../usecases/ChannelUseCases";
import {globalInstancesFactory} from "@hermes/composition";
import {TopicService, TopicServiceConfiguration} from "@hermes/topicservice";
import {User as UserEntity, User} from "@nodecms/backend-data";
import {isNumber} from "@nodecms/backend-data";
import {NotFoundError} from "@nodecms/backend-data";
import {AlreadyExistsError} from "@nodecms/backend-data";
import {ChannelRules} from "@nodecms/backend-data-rules";

type ChannelDTO = Partial<ChannelEntity>;

interface ServiceOptions extends BaseServiceConfiguration {
  topicService:{
    contractName:string
    configuration?:any
  }
}

export class Channel extends BaseService<ChannelDTO, ChannelRules, ChannelUseCases> {

  options: ServiceOptions;
  private topicService: TopicService;

  constructor (options: ServiceOptions = {
    storage: { contractName: 'Default'},
    topicService: { contractName: 'Default'}
  }, app: Application) {
    super(app, 'channel','Channel', options);
    this.options = options;
    this.topicService = globalInstancesFactory.getInstanceFromCatalogs('TopicService',
      options.topicService.contractName,
      TopicServiceConfiguration.load(options.topicService.configuration))
  }
  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<ChannelDTO[] | Paginated<ChannelDTO>> {
    if(params){
      const executingUser:UserEntity = params?.user as UserEntity;
      return await this.useCase.find(params.query as Partial<Channel>,undefined, executingUser);
    }
    return [];
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<ChannelDTO> {
    try{
      if(params && params.user){
        return await this.useCase.get(id, params.user as User);
      }
    }catch(err){
      if(err as NotFoundError){
        console.log(err.message);
        throw new NotFound(err.message);
      } else {
        throw err
      }
    }
    throw new NotFound(`No Channel with id ${id}`);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async create (data: ChannelDTO, params?: Params): Promise<ChannelDTO> {
    if(params && params.user && params.user as User) {
      try{
        const newChannel = await this.useCase.create(data, params.user as User);
        try{
          await this.topicService.publish('channels.actions', {
            action:'creation',
            channel:newChannel.id
          })
        } catch(error) {
          console.warn(error.message);
        }
        return newChannel;
      } catch(err) {
        if(err as AlreadyExistsError){
          console.log(err.message)
          throw new NotAcceptable(err.message);
        }
      }
    }
    throw new NotAuthenticated('User is not authenticated.');
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: ChannelDTO, params?: Params): Promise<ChannelDTO> {
    if(id !== null && data && params){
      const executingUser:User = params.user as User;
      return await this.useCase.update(id, data, executingUser);
    }
    throw new NotAcceptable('Id or data is null or undefined');
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async patch (id: NullableId, data: ChannelDTO, params?: Params): Promise<ChannelDTO> {
    return await this.update(id,data, params);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async remove (id: NullableId, params?: Params): Promise<ChannelDTO> {
    const executingUser:UserEntity = params?.user as UserEntity;
    if(id){
      return await this.useCase.delete(id, executingUser)
    }
    throw new NotFound(`No channel with id : ${id}`);
  }

  async isDataAuthorized(data: any, right: string, user: any): Promise<boolean> {
    const channel:ChannelEntity = data as ChannelEntity;
    return await this.useCase.isDataAuthorized(data, right, user);
  }

  async needAuthentication(context: any): Promise<boolean> {
    return true;
  }

}
