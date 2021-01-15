import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {Media as MediaEntity, MediaVisibility} from "../../entities/Media";
import {BaseService, BaseServiceConfiguration} from "../BaseService";
import {MediaUseCases} from "../../usecases/MediaUseCases";
import {NotAuthenticated, NotImplemented} from "@feathersjs/errors";
import {User as UserEntity} from "../../entities/User";
import {isNumber} from "../../helpers";

type MediaDTO = Partial<MediaEntity>

interface ServiceOptions extends BaseServiceConfiguration {
  paginate?:number,
  storage: {
    contractName:string;
    configuration?:any
    fsStore:string
  }
}

export class Media extends BaseService<MediaDTO, MediaUseCases> {
  app: Application;
  options: ServiceOptions;

  constructor (options: ServiceOptions = {
    storage: { contractName: 'Default', fsStore: 'fsStore'}
  }, app: Application) {
    super(app, 'media', 'Media', options)
    this.options = options;
    this.app = app;
  }

  async find (params?: Params): Promise<MediaDTO[] | Paginated<MediaDTO>> {
    const medias = await this.useCase.find(params?.query as MediaDTO, params?.user as UserEntity);
    return medias;
  }

  async get (id: Id, params?: Params): Promise<MediaDTO> {
    const media = await this.useCase.get(id.toString(), params?.user as UserEntity);
    return media
  }

  async create (data: MediaDTO, params?: Params): Promise<MediaDTO> {
    if(params && params.user && params.user as UserEntity) {
      return await this.useCase.create(data,params.user as UserEntity)
    }

    throw new NotAuthenticated('User is not authenticated.');
  }

  async update (id: NullableId, data: MediaDTO, params?: Params): Promise<MediaDTO> {
    throw new NotImplemented();
  }

  async patch (id: NullableId, data: MediaDTO, params?: Params): Promise<MediaDTO> {
    throw new NotImplemented();
  }

  async remove (id: NullableId, params?: Params): Promise<MediaDTO> {
    if(params && params.user && params.user as UserEntity && id){
      return this.useCase.delete(id, params.user as UserEntity);
    }
    throw new NotAuthenticated('User is not authenticated.');
  }

  async isDataAuthorized(data: any, right: string, user: any): Promise<boolean> {
    if(Array.isArray(data)){
      const items = [...data]
      for(const item of items){
        if(!await this.isDataAuthorized(item, right, user)){
          data.splice(data.indexOf(item), 1);
        }
      }
      return data.length > 0;
    } else {
      const media = data as MediaEntity;
      if(media &&
        right === 'r' &&
        media.visibility === MediaVisibility.public) {
        return true
      } else {
        return this.useCase.isDataAuthorized(media, right, user);
      }
    }
  }

  async needAuthentication(context: any): Promise<boolean> {
    if(context.method.toLowerCase() === 'get' || context.method.toLowerCase() === 'find') {
      if(context.id || context.id === 0){
        if(isNumber(context.id)) {
          const data = await this.useCase.get(context.id)
          if(data)
            return data.visibility !== MediaVisibility.public;
        } else {
          const filtered = await this.useCase.find({ key: context.id.toString()})
          if(filtered && filtered.length > 0) {
            for(const m of filtered){
              if(m.visibility !== MediaVisibility.public)
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
              if(m.visibility !== MediaVisibility.public)
                return true
            }
            return false;
          }
        }
      }
    }
    return true;
  }
}
