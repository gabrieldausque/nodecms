import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import { WebThumbnail as WebThumbnailEntity } from "../../entities/WebThumbnail";
import {MethodNotAllowed, NotAuthenticated, NotImplemented} from "@feathersjs/errors";
import {UserUseCases} from "../../usecases/UserUseCases";
import {globalInstancesFactory} from "@hermes/composition";
import {User, User as UserEntity} from '../../entities/User';
import {WebThumbnailUseCase} from "../../usecases/WebThumbnailUseCase";

type WebThumbnailDTO = Partial<WebThumbnailEntity>;

interface ServiceOptions {}

export class WebThumbnail implements ServiceMethods<WebThumbnailDTO> {
  app: Application;
  options: ServiceOptions;

  useCase:WebThumbnailUseCase

  constructor (options: ServiceOptions = {}, app: Application) {
    this.options = options;
    this.app = app;
    this.useCase = globalInstancesFactory.getInstanceFromCatalogs('UseCases','WebThumbnail');
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<WebThumbnailDTO[] | Paginated<WebThumbnailDTO>> {
    if(params && params.query){
      if(typeof params.query.id === 'string')
      {
        return [await this.get(params.query.id, params)];
      }
    }
    throw new MethodNotAllowed()
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<WebThumbnailDTO> {
    if(!params || !params.user){
      throw new NotAuthenticated();
    }
    return await this.useCase.get(id.toString(), params.user as any);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async create (data: WebThumbnailDTO, params?: Params): Promise<WebThumbnailDTO> {
    throw new MethodNotAllowed();
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: WebThumbnailDTO, params?: Params): Promise<WebThumbnailDTO> {
    throw new MethodNotAllowed();
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async patch (id: NullableId, data: WebThumbnailDTO, params?: Params): Promise<WebThumbnailDTO> {
    throw new MethodNotAllowed();
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async remove (id: NullableId, params?: Params): Promise<WebThumbnailDTO> {
    throw new MethodNotAllowed();
  }

  async needAuthentication(context:any):Promise<boolean> {
    return true;
  }

  async isAuthorized(context: any): Promise<boolean> {
    if(context.params.user) {
      const userUseCase: UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'User');
      const user = context.params.user as UserEntity
      return await userUseCase.isValidUser(user,user);
    }
    return false
  }

  async isDataAuthorized(data:any, right:string, user?:any):Promise<boolean> {
    if(user as UserEntity){
      const userUseCase: UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'User');
      return userUseCase.isValidUser(user,user);
    }
    return false;
  }

  async validAuthentication(params:any, extractUser:boolean = false) {
   //TODO : replace using the authentication use case !

    if(!params.clientId){
      throw new NotAuthenticated('You are missing your unique clientId. Please correct and retry.');
    }

    if(!params.realm) {
      throw new NotAuthenticated('No realm specified, authentication can\'t be checked. Please authenticate.');
    }

    const appRealm = this.app.get('authentication').realm;
    if(params.realm.trim() !== appRealm.trim()) {
      // TODO : if not local authority keys, call other www-authenticate realm to check token
      throw new NotImplemented('Federation of authentication not implemented. Will be done in further release');
    } else {
      //TODO : replace this by a useCase (Currently not implemented)
      const authenticationService = this.app.service('authentication');
      const userUseCase:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','User');
      const login = authenticationService.encryptor.decryptClientId(params.clientId);
      const userIsAuthenticated = await authenticationService.get(login, params);
      if(!userIsAuthenticated && !extractUser) {
        throw new NotAuthenticated('Please authenticate before using this application');
      } else {
        params.user = await userUseCase.get(login);
        //TODO : add user role from local or other www-authenticate realm
      }
    }
  }

}
