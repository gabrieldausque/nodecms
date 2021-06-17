import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {UserEvent} from "@nodecms/backend-data";
import {BaseService, BaseServiceConfiguration} from "../BaseService";
import {UserEventEntityRules} from "@nodecms/backend-data-rules/dist/UserEventEntityRules";
import {UserEventUseCases} from "../../usecases/UserEventUseCases";

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

}
