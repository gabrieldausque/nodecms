import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {BaseService, BaseServiceConfiguration} from "../BaseService";
import {AuthorizationUseCases} from "../../usecases/AuthorizationUseCases";
import {User, User as UserEntity} from "../../entities/User";
import {DocumentUseCases} from "../../usecases/DocumentUseCases";
import {Document as DocumentEntity, DocumentVisibility} from "../../entities/Document";
import {NotAcceptable, NotAuthenticated, NotFound} from "@feathersjs/errors";
import {isNumber} from "../../helpers";

type DocumentDTO = Partial<DocumentEntity>

interface ServiceOptions extends BaseServiceConfiguration {

}

export class Document extends BaseService<DocumentDTO, DocumentUseCases> {

  options: ServiceOptions;

  constructor (options: ServiceOptions = {
    storage:{
      contractName:'Default'
    }
  }, app: Application) {
    super(app,'document', 'Document', options);
    this.options = options;
  }

  async find (params?: Params): Promise<DocumentDTO[] | Paginated<DocumentDTO>> {
    if(params){
      const executingUser:UserEntity = params?.user as UserEntity;
      return await this.useCase.find(params.query as Partial<DocumentEntity>,executingUser);
    }
    return [];
  }

  async get (id: Id, params?: Params): Promise<DocumentDTO> {
    if(params){
      return await this.useCase.get(id, params.user as User);
    }
    throw new NotFound(`No Document with id ${id}`);
  }

  async create (data: DocumentDTO, params?: Params): Promise<DocumentDTO> {
    if(params && params.user && params.user as User)
      return await this.useCase.create(data, params.user as User)
    throw new NotAuthenticated('User is not authenticated.');
  }

  async update (id: NullableId, data: DocumentDTO, params?: Params): Promise<DocumentDTO> {
    if(id !== null && data && params){
      const executingUser:User = params.user as User;
      return await this.useCase.update(id, data, executingUser);
    }
    throw new NotAcceptable('Id or data is null or undefined');
  }

  async patch (id: NullableId, data: DocumentDTO, params?: Params): Promise<DocumentDTO> {
    return await this.update(id,data,params);
  }

  async remove (id: NullableId, params?: Params): Promise<DocumentDTO> {
    const executingUser:UserEntity = params?.user as UserEntity;
    if(id){
      return await this.useCase.delete(id, executingUser)
    }
    throw new NotFound(`No Document with id : ${id}`);
  }

  async needAuthentication(context: any): Promise<boolean> {
    if(context.method.toLowerCase() === 'get' || context.method.toLowerCase() === 'find') {
      if(context.id || context.id === 0){
        if(isNumber(context.id)) {
          let usableId = parseInt(context.id.toString());
          try{
            const data = await this.useCase.get(usableId);
            if(data)
              return data.visibility !== DocumentVisibility.public;
          }catch(error){
            console.error(error)
          }
        } else {
          const filtered = await this.useCase.find({ key: context.id.toString()})
          if(filtered && filtered.length > 0) {
            for(const m of filtered){
              if(m.visibility !== DocumentVisibility.public)
                return true
            }
            return false;
          }
        }
      } else {
        if(context.params.query) {
          const filtered = await this.useCase.find(context.params.query);
          if(filtered && filtered.length > 0) {
            for(const m of filtered){
              if(m.visibility !== DocumentVisibility.public)
                return true
            }
            return false;
          }
        }
      }
    }
    return true;
  }

  async isDataAuthorized(data: any,right:string='r',user?:UserEntity):Promise< boolean> {
    if(Array.isArray(data)){
      const items = [...data]
      for(const item of items){
        if(!await this.isDataAuthorized(item, right, user)){
          data.splice(data.indexOf(item), 1);
        }
      }
      return data.length > 0;
    } else {
      const document = data as DocumentEntity;
      if(document &&
        right === 'r' &&
        document.visibility === DocumentVisibility.public) {
        return true
      } else {
        return this.useCase.isDataAuthorized(document, right, user);
      }
    }
  }

}
