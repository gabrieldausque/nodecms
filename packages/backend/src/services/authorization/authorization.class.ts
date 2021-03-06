import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {BaseService, BaseServiceConfiguration} from "../BaseService";
import {AuthorizationUseCases} from "../../usecases/AuthorizationUseCases";
import {MethodNotAllowed, NotAcceptable, NotAuthenticated, NotFound, NotImplemented} from "@feathersjs/errors";
import {Authorization as AuthorizationEntity} from "@nodecms/backend-data";
import {User as UserEntity} from "@nodecms/backend-data";
import {AuthorizationEntityRules} from "@nodecms/backend-data-rules";

type AuthorizationDTO = Partial<AuthorizationEntity>;

interface ServiceOptions extends BaseServiceConfiguration {}

export class Authorization extends BaseService<AuthorizationDTO,
  AuthorizationEntityRules,
  AuthorizationUseCases> {

  app: Application;
  options: ServiceOptions;

  constructor (options: ServiceOptions = {
    storage:{
      contractName:'Default'
    }
  }, app: Application) {
    super(app, 'authorization', 'Authorization', options)
    this.options = options;
    this.app = app;
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<AuthorizationDTO[] | Paginated<AuthorizationDTO>> {
    if(params && params.query) {
      const filter = {
        on: params.query.on,
        onType: params.query.onType,
        for: params.query.for,
        role: params.query.role,
        right: params.query.right
      }
      if(params.user as UserEntity){
        const found = await this.useCase.find(filter, undefined, params.user as UserEntity);
        if(Array.isArray(found) && found.length > 0)
          return found;
      }
    }
    throw new NotFound('No authorization found or executing user doesn\'t exists');
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<AuthorizationDTO> {
    if(params) {
      const executingUser:UserEntity = params.user as UserEntity;
      return await this.useCase.get(id, executingUser);
    }
    throw new NotAuthenticated('User is not authenticated');
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async create (data: AuthorizationDTO, params?: Params): Promise<AuthorizationDTO> {
    if(params) {
      const executingUser:UserEntity = params.user as UserEntity;
      return this.useCase.create(data, executingUser);
    }
    throw new NotAuthenticated('User is not authenticated');
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: AuthorizationDTO, params?: Params): Promise<AuthorizationDTO> {
    throw new MethodNotAllowed();
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async patch (id: NullableId, data: AuthorizationDTO, params?: Params): Promise<AuthorizationDTO> {
    throw new MethodNotAllowed();
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async remove (id: NullableId, params?: Params): Promise<AuthorizationDTO> {
    if(!id)
      throw new NotAcceptable('id must be set');
    if(params) {
      const executingUser:UserEntity = params.user as UserEntity;
      return this.useCase.delete(id, executingUser)
    }
    throw new NotAuthenticated('User is not authenticated');
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
