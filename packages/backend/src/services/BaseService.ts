import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import {Application} from "../declarations";
import {NotAcceptable, NotAuthenticated, NotImplemented} from "@feathersjs/errors";
import app from "../app";
import {UserUseCases} from "../usecases/UserUseCases";
import { globalInstancesFactory } from '@hermes/composition';
import {UseCases} from "../usecases/UseCases";
import {AuthenticationUseCases} from "../usecases/AuthenticationUseCases";
import {isNumber} from "@nodecms/backend-data";

export interface BaseServiceConfiguration {
  paginate?:number
  storage: {
    contractName:string;
    configuration?:any
  }
}

export abstract class BaseService<T, U extends UseCases<T>> implements ServiceMethods<T> {

  app: Application;
  serviceLabel: string;
  useCase: U

  protected constructor(app:Application, serviceLabel:string,useCaseContractName:string, options:BaseServiceConfiguration) {
    this.app = app;
    this.serviceLabel = serviceLabel;
    const f = globalInstancesFactory;
    this.useCase = f.getInstanceFromCatalogs(
      'UseCases',
      useCaseContractName,
      options) as U;
  }

    abstract find(params?: Params | undefined): Promise<T | T[] | Paginated<T>>

    abstract get(id: Id, params?: Params | undefined): Promise<T>

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
      }, context.params.user)
    }
    return false;
  }

  abstract isDataAuthorized(data:any, right:string, user?:any):Promise<boolean>;

  async validAuthentication(params:any, extractUser:boolean = false) {

    const authenticationUseCases:AuthenticationUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Authentication');

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
      const userUseCase:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','User');
      const login = (await authenticationUseCases.getLoginFromEncryptedToken(params.authenticationToken));
      if(!login && !extractUser) {
        throw new NotAuthenticated('Please authenticate before using this application');
      } else {
        params.user = await userUseCase.get(login);
        //TODO : add user role from local or other www-authenticate realm
      }
    }
  }

  async extractLastIndex(params:any):Promise<number | undefined>{
    let lastIndex:number | string | undefined = params.query?.lastIndex;
    let result:number | undefined = undefined;
    if(typeof lastIndex === 'number') {
      result = lastIndex
    } else if(isNumber(lastIndex) && typeof lastIndex === 'string')
      result = parseInt(lastIndex)

    if(params.query && params.query.hasOwnProperty('lastIndex'))
      delete params.query.lastIndex;

    return result;
  }
}
