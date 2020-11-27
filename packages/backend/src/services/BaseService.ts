import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import {Application} from "../declarations";
import {NotAcceptable, NotAuthenticated, NotImplemented} from "@feathersjs/errors";
import app from "../app";
import {UserUseCases} from "../usecases/UserUseCases";
import { globalInstancesFactory } from '@hermes/composition';

export abstract class BaseService<T> implements ServiceMethods<T> {

  app: Application;
  serviceLabel: string;

  protected constructor(app:Application, serviceLabel:string) {
    this.app = app;
    this.serviceLabel = serviceLabel;
  }

    abstract async find(params?: Params | undefined): Promise<T | T[] | Paginated<T>>

    abstract async get(id: Id, params?: Params | undefined): Promise<T>

    abstract create(data: Partial<T> | Partial<T>[], params?: Params | undefined): Promise<T | T[]>

    abstract update(id: NullableId, data: T, params?: Params | undefined): Promise<T | T[]>

    abstract patch(id: NullableId, data: Partial<T>, params?: Params | undefined): Promise<T | T[]>

    abstract remove(id: NullableId, params?: Params | undefined): Promise<T | T[]>

  abstract needAuthentication(context:any):Promise<boolean>;

  async isAuthorized(context: any): Promise<boolean> {
    if(context.params.user){
      const userUseCase:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','User');
      return await userUseCase.isUserAuthorized(context.params.user, {
        on: 'operation',
        onType: context.method,
        for: this.serviceLabel,
        right:'x'
      })
    }
    return false;
  }

  abstract isDataAuthorized(data:any, right:string, user?:any):Promise<boolean>;

  async validAuthentication(params:any) {
    if(!params.clientId){
      throw new NotAuthenticated('You are missing your unique clientId. Please correct and retry.');
    }

    if(!params.realm) {
      throw new NotAuthenticated('No realm specified, authentication can\'t be checked. Please authenticate.');
    }

    const appRealm = app.get('authentication').realm;
    if(params.realm.trim() !== appRealm.trim()) {
      // TODO : if not local authority keys, call other www-authenticate realm to check token
      throw new NotImplemented('Federation of authentication not implemented. Will be done in further release');
    } else {
      //TODO : replace this by a useCase (Currently not implemented)
      const authenticationService = this.app.service('authentication');
      const userUseCase:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','User');
      const login = authenticationService.encryptor.decryptClientId(params.clientId);
      const userIsAuthenticated = await authenticationService.get(login, params);
      if(!userIsAuthenticated) {
        throw new NotAuthenticated('Please authenticate before using this application');
      } else {
        params.user = await userUseCase.get(login);
        //TODO : add user role from local or other www-authenticate realm
      }
    }
  }
}
