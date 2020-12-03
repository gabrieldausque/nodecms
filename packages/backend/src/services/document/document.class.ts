import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {BaseService, BaseServiceConfiguration} from "../BaseService";
import {AuthorizationUseCases} from "../../usecases/AuthorizationUseCases";
import {User as UserEntity} from "../../entities/User";
import {DocumentUseCases} from "../../usecases/DocumentUseCases";

interface Data {}

interface ServiceOptions extends BaseServiceConfiguration {

}

export class Document extends BaseService<Data, DocumentUseCases> {

  options: ServiceOptions;

  constructor (options: ServiceOptions = {
    storage:{
      contractName:'Default'
    }
  }, app: Application) {
    super(app,'document', 'Document', options);
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

  async needAuthentication(): Promise<boolean> {
    return true;
  }

  async isAuthorized(context: any): Promise<boolean> {
    return false;
  }

  async isDataAuthorized(data: any,right:string='r',user?:UserEntity):Promise< boolean> {
    throw new Error("Method not implemented.");
  }

}
