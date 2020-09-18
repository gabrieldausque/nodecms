import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {BaseService} from "../BaseService";

interface Data {}

interface ServiceOptions {}

export class Document extends BaseService implements ServiceMethods<Data> {
  options: ServiceOptions;

  constructor (options: ServiceOptions = {}, app: Application) {
    super(app);
    this.options = options;
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

  [key: string]: any;

  needAuthentication(): boolean {
    return true;
  }

  isAuthorized(context: any): boolean {
    throw new Error("Method not implemented.");
  }
  isDataAuthorized(data: any): boolean {
    throw new Error("Method not implemented.");
  }

}
