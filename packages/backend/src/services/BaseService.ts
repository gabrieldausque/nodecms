import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import {Application} from "../declarations";
import {NotFound, NotAcceptable, NotAuthenticated, NotImplemented} from "@feathersjs/errors";
import app from "../app";
import {UserUseCases} from "../usecases/UserUseCases";
import { globalInstancesFactory } from '@hermes/composition';
import {UseCases} from "../usecases/UseCases";
import {AuthenticationUseCases} from "../usecases/AuthenticationUseCases";
import {
  Document as DocumentEntity,
  DocumentVisibility, Entity,
  isNumber,
  User as UserEntity,
  User
} from "@nodecms/backend-data";
import {EntityRules} from "@nodecms/backend-data-rules";

export interface BaseServiceConfiguration {
  paginate?:number
  storage: {
    contractName:string;
    configuration?:any
  }
}

export abstract class BaseService<T extends Entity,
  ER extends EntityRules<T>,
  U extends UseCases<T, ER>> implements ServiceMethods<T> {

  app: Application;
  serviceLabel: string;
  useCase: U

  protected constructor(app:Application, serviceLabel:string, useCaseContractName:string, options:BaseServiceConfiguration) {
    this.app = app;
    this.serviceLabel = serviceLabel;
    const f = globalInstancesFactory;
    this.useCase = f.getInstanceFromCatalogs(
      'UseCases',
      useCaseContractName,
      options) as U;
  }

    async find(params?: Params | undefined): Promise<T | T[] | Paginated<T>> {
      if(params){
        const executingUser:UserEntity = params?.user as UserEntity;
        const lastIndex:number | undefined = await this.extractLastIndex(params);
        return await this.useCase.find(params.query as Partial<T>,
          lastIndex,
          executingUser);
      }
      return [];
    }

    async get(id: Id, params?: Params | undefined): Promise<T> {
      if(params){
        const found = await this.useCase.get(id, params.user as User);
        return found;
      }
      throw new NotFound(`No Entity with id ${id}`);
    }

    async create(data: Partial<T> | Partial<T>[], params?: Params | undefined): Promise<T | T[]> {
      if(params && params.user && params.user as User){
        if(Array.isArray(data))
        {
          const creationPromises:Promise<Partial<T> | Partial<T>[]>[] = []
          for(let atomicData of data){
            creationPromises.push(this.create(atomicData, params))
          }
          return (await Promise.all(creationPromises)).map((r) => r as T);
        } else {
          return await this.useCase.create(data as T, params.user as User);
        }
      }
      throw new NotAuthenticated('User is not authenticated.');
    }

    async update(id: NullableId, data: T, params?: Params | undefined): Promise<T | T[]> {
      if(id !== null && data && params){
        const executingUser:User = params.user as User;
        return await this.useCase.update(id, data, executingUser);
      }
      throw new NotAcceptable('Id or data is null or undefined');
    }

    async patch(id: NullableId, data: Partial<T>, params?: Params | undefined): Promise<T | T[]> {
      return await this.update(id,data as T,params);
    }

    async remove(id: NullableId, params?: Params | undefined): Promise<T | T[]> {
      const executingUser:UserEntity = params?.user as UserEntity;
      if(id){
        return await this.useCase.delete(id, executingUser)
      }
      throw new NotFound(`No Document with id : ${id}`);
    }

  async needAuthentication(context:any):Promise<boolean> {
    return true;
  }

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

  async isDataAuthorized(data:any, right:string, user?:any):Promise<boolean> {
    if(Array.isArray(data)){
      const items = [...data]
      for(const item of items){
        if(!await this.isDataAuthorized(item, right, user)){
          data.splice(data.indexOf(item), 1);
        }
      }
      return data.length > 0;
    } else {
        return this.useCase.isDataAuthorized(data as T, right, user);
    }
  }

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
