import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {UserEvent} from "@nodecms/backend-data";
import {BaseService, BaseServiceConfiguration} from "../BaseService";
import {UserEventEntityRules} from "@nodecms/backend-data-rules/dist/UserEventEntityRules";
import {UserEventUseCases} from "../../usecases/UserEventUseCases";
import { globalInstancesFactory } from '@hermes/composition';

type UserEventDTO = Partial<UserEvent>;

interface ServiceOptions extends BaseServiceConfiguration {}

export class UserEvents extends BaseService<UserEventDTO,
  UserEventEntityRules,
  UserEventUseCases> {
  app: Application;
  options: ServiceOptions;

  constructor (options: ServiceOptions = {
    storage:{
      contractName:'Default'
    }
  }, app: Application) {
    super(app, 'user-events', 'UserEvent', options)
    this.options = options;
    this.app = app;
  }

  async get(id:Id, params?: | undefined): Promise<UserEventDTO>{
    return await super.get(id,params)
  }

  async create(data: UserEventDTO | UserEventDTO[], params?: Params | undefined): Promise<UserEventDTO | UserEventDTO[]>{
    if(params &&
      params.route &&
      params.route.idOrLogin
    ){
      const userUseCase = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'User');
      const user = await userUseCase.get(params.route.idOrLogin);
      if(Array.isArray(data)){
        for(const e of data){
          e.ownerId = user.id;
        }
      } else {
        data.ownerId = user.id;
      }
    }
    return await super.create(data, params);
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
    console.log(`found length : ${Array.isArray(found)?found.length:''}`);
    return found
  }
}
