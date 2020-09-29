import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {BaseService} from "../BaseService";
import {globalInstancesFactory} from "@hermes/composition";
import {AuthorizationUseCases} from "../../usecases/AuthorizationUseCases";
import {Authorization as AuthorizationEntity} from "../../plugins/Storages/Authorization/AuthorizationStorage";
import {query} from "winston";
import {MethodNotAllowed, NotAcceptable, NotFound, NotImplemented} from "@feathersjs/errors";

type Data = AuthorizationEntity;

interface ServiceOptions {}

export class Authorization extends BaseService<Data> {
  isAuthorized(context: any): boolean {
      throw new Error("Method not implemented.");
  }
  app: Application;
  options: ServiceOptions;
  private useCase: AuthorizationUseCases;

  constructor (options: ServiceOptions = {}, app: Application) {
    super(app)
    this.options = options;
    this.app = app;
    this.useCase = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Authorization', options);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<Data[] | Paginated<Data>> {
    if(params && params.query) {
      const filter = {
        on: params.query.on,
        onType: params.query.onType,
        for: params.query.for,
        role: params.query.role,
        right: params.query.right
      }
      const found = this.useCase.find(filter);
      if(Array.isArray(found) && found.length > 0)
        return found;
    }
    throw new NotFound();
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<Data> {
    throw new NotImplemented();
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async create (data: Data, params?: Params): Promise<Data> {
    return this.useCase.create(data);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: Data, params?: Params): Promise<Data> {
    throw new MethodNotAllowed();
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async patch (id: NullableId, data: Data, params?: Params): Promise<Data> {
    throw new MethodNotAllowed();
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async remove (id: NullableId, params?: Params): Promise<Data> {
    if(!id)
      throw new NotAcceptable('id must be set');
    return this.useCase.delete(id)
  }

  needAuthentication(context: any): boolean {
    return true;
  }
}
