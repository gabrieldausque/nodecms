import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {BaseService} from "../BaseService";
import {globalInstancesFactory} from "@hermes/composition";
import {AuthorizationUseCases} from "../../usecases/AuthorizationUseCases";
import {query} from "winston";
import {MethodNotAllowed, NotAcceptable, NotFound, NotImplemented} from "@feathersjs/errors";
import {UserUseCases} from "../../usecases/UserUseCases";
import {Authorization as AuthorizationEntity} from "../../entities/Authorization";
import {User as UserEntity} from "../../entities/User";

type Data = AuthorizationEntity;

interface ServiceOptions {}

export class Authorization extends BaseService<Data> {

  app: Application;
  options: ServiceOptions;
  public useCase: AuthorizationUseCases;

  constructor (options: ServiceOptions = {}, app: Application) {
    super(app, 'authorization')
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
      const found = await this.useCase.find(filter);
      if(Array.isArray(found) && found.length > 0)
        return found;
    }
    throw new NotFound('No authorization found');
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<Data> {
    return await this.useCase.get(id);
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

  async isAuthorized(context: any): Promise<boolean> {
    if(context.method.toLowerCase() === 'update' ||
    context.method.toLowerCase() === 'patch'
    )
      throw new MethodNotAllowed(`Method ${context.method} is not allowed`);
    return super.isAuthorized(context);
  }

  async needAuthentication(context: any): Promise<boolean> {
    return true;
  }

  async isDataAuthorized(data: any,right:string='r',user?:UserEntity):Promise< boolean> {
    return true;
  }

}
