import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {UserEvent} from "@nodecms/backend-data";
import {BaseService, BaseServiceConfiguration} from "../BaseService";
import {UserEventEntityRules} from "@nodecms/backend-data-rules/dist/UserEventEntityRules";
import {UserEventUseCases} from "../../usecases/UserEventUseCases";
import { globalInstancesFactory } from '@hermes/composition';
import { TopicService, TopicServiceConfiguration } from '@hermes/topicservice';

type UserEventDTO = Partial<UserEvent>;

interface ServiceOptions extends BaseServiceConfiguration {
  topicService:{
    contractName:string
    configuration?:any
  }
}

export class UserEvents extends BaseService<UserEventDTO,
  UserEventEntityRules,
  UserEventUseCases> {
  app: Application;
  options: ServiceOptions;
  private topicService: TopicService;

  constructor (options: ServiceOptions = {
    storage:{
      contractName:'Default'
    },
    topicService: { contractName: 'Default'}
  }, app: Application) {
    super(app, 'user-events', 'UserEvent', options)
    this.options = options;
    this.app = app;
    this.topicService = globalInstancesFactory.getInstanceFromCatalogs('TopicService',
      options.topicService.contractName, TopicServiceConfiguration.load(options.topicService.configuration));
  }

  async get(id:Id, params?: | undefined): Promise<UserEventDTO>{
    return await super.get(id,params)
  }

  async create(data: UserEventDTO | UserEventDTO[], params?: Params | undefined): Promise<UserEventDTO | UserEventDTO[]>{
    const userUseCase = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'User');
    if(params &&
      params.route &&
      params.route.idOrLogin
    ){
      const user = await userUseCase.get(params.route.idOrLogin);
      if(Array.isArray(data)){
        for(const e of data){
          e.ownerId = user.id;
        }
      } else {
        data.ownerId = user.id;
      }
    }
    const created = await super.create(data, params);
    const user = await userUseCase.get((created as UserEvent).ownerId);
    await this.topicService.publish(`user-events.actions.${user.login}`, {
      action:'creation',
      owner: user.login
    })
    return created;
  }

  async update(id:NullableId, data:UserEventDTO, params?: Params | undefined) {
    const userUseCase = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'User');
    if(params &&
      params.route &&
      params.route.idOrLogin
    ){
      const user = await userUseCase.get(params.route.idOrLogin);
      if(Array.isArray(data)){
        for(const e of data){
          e.ownerId = user.id;
        }
      } else {
        data.ownerId = user.id;
      }
    }
    const updated = await super.update(id, data, params);
    const user = await userUseCase.get((updated as UserEvent).ownerId);
    await this.topicService.publish(`user-events.actions.${user.login}`, {
      action:'update',
      owner: user.login
    })
    return updated;
  }

  async find(params?: Params | undefined): Promise<UserEventDTO | UserEventDTO[] | Paginated<UserEventDTO>> {
    if(params &&
      params.query &&
      params.route &&
      params.route.idOrLogin
    ) {
      const userUseCase = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'User');
      const user = await userUseCase.get(params.route.idOrLogin);
      params.query.ownerId = user.id;
    }
    const found = await super.find(params)
    return found
  }
}
