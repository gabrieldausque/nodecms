import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {UserEvent} from "@nodecms/backend-data";
import {BaseService, BaseServiceConfiguration} from "../BaseService";

type UserEventDTO = Partial<UserEvent>;

interface ServiceOptions extends BaseServiceConfiguration {}

export class UserEvents extends BaseService<UserEventDTO, UserEventUseCases> {
  app: Application;
  options: ServiceOptions;

  constructor (options: ServiceOptions = {
    storage:{
      contractName:'Default'
    }
  }, app: Application) {
    this.options = options;
    this.app = app;
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<UserEventDTO[] | Paginated<UserEventDTO>> {
    return [];
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<UserEventDTO> {
    return {
      id, text: `A new message with ID: ${id}!`
    };
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async create (data: UserEventDTO, params?: Params): Promise<UserEventDTO> {
    if (Array.isArray(data)) {
      return Promise.all(data.map(current => this.create(current, params)));
    }

    return data;
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: UserEventDTO, params?: Params): Promise<UserEventDTO> {
    return data;
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async patch (id: NullableId, data: UserEventDTO, params?: Params): Promise<UserEventDTO> {
    return data;
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async remove (id: NullableId, params?: Params): Promise<UserEventDTO> {
    return { id };
  }
}
