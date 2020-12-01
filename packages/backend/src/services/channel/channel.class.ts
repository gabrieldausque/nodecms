import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {Channel as ChannelEntity, ChannelVisibility} from '../../entities/Channel'
import {BaseService} from "../BaseService";
import {NotAuthenticated, NotFound, NotImplemented} from "@feathersjs/errors";
import {ChannelUseCases} from "../../usecases/ChannelUseCases";
import {globalInstancesFactory} from "@hermes/composition";
import {TopicService, TopicServiceConfiguration} from "@hermes/topicservice";
import {Channel as ChannelDTO} from '../../entities/Channel'
import {User} from "../../entities/User";

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

export class Channel extends BaseService<ChannelDTO> {

  options: ServiceOptions;
  private useCase: ChannelUseCases;
  private topicService: TopicService;

  constructor (options: ServiceOptions = {
    storage: { contractName: 'Default'},
    topicService: { contractName: 'Default'}
  }, app: Application) {
    super(app, 'channel')
    this.options = options;
    this.useCase = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Channel', options)
    this.topicService = globalInstancesFactory.getInstanceFromCatalogs('TopicService',
      options.topicService.contractName,
      TopicServiceConfiguration.load(options.topicService.configuration))
  }
  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<ChannelDTO[] | Paginated<ChannelDTO>> {
    throw new NotImplemented();
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<ChannelDTO> {
    if(params && params.user){
      return await this.useCase.get(id, params.user as User);
    }
    throw new NotFound(`No Channel with id ${id}`);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async create (data: ChannelDTO, params?: Params): Promise<ChannelDTO> {
    if(params && params.user)
      return await this.useCase.create(data, params.user as User)
    throw new NotAuthenticated('User is not authenticated.');
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: ChannelDTO, params?: Params): Promise<ChannelDTO> {
    throw new NotImplemented();
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async patch (id: NullableId, data: ChannelDTO, params?: Params): Promise<ChannelDTO> {
    throw new NotImplemented();
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async remove (id: NullableId, params?: Params): Promise<ChannelDTO> {
    throw new NotImplemented();
  }

  async isDataAuthorized(data: any, right: string, user: any): Promise<boolean> {
    const channel:ChannelEntity = data as ChannelEntity;
    if(channel.visibility === ChannelVisibility.public ||
       channel.visibility === ChannelVisibility.protected)
      return true;
    else
      return this.useCase.isUserMemberOf(channel,user, user);
  }

  async needAuthentication(context: any): Promise<boolean> {
    return true;
  }

}
