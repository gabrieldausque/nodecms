import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {globalInstancesFactory} from "@hermes/composition";
import AuthenticationPlugin from "../../plugins/interfaces/AuthenticationPlugin";

interface Data {}

interface ServiceOptions {
  contractName:string,
  configuration?:any
}

export class Authentication implements ServiceMethods<Data> {
  app: Application;
  options: ServiceOptions;
  authenticator: AuthenticationPlugin

  constructor (options: ServiceOptions = { contractName:'Default'}, app: Application) {
    this.options = options;
    this.app = app;
    this.authenticator = globalInstancesFactory.getInstanceFromCatalogs('AuthenticationPlugin', options.contractName, options.configuration)
  }

  async find (params?: Params): Promise<Data[] | Paginated<Data>> {
    return [];
  }

  async get (id: Id, params?: Params): Promise<Data> {
    return {
      id, text: `A new message with ID: ${id}!`
    };
  }

  async create (data: Data, params?: Params): Promise<Data> {
    if (Array.isArray(data)) {
      return Promise.all(data.map(current => this.create(current, params)));
    }

    return data;
  }

  async update (id: NullableId, data: Data, params?: Params): Promise<Data> {
    return data;
  }

  async patch (id: NullableId, data: Data, params?: Params): Promise<Data> {
    return data;
  }

  async remove (id: NullableId, params?: Params): Promise<Data> {
    return { id };
  }
}
