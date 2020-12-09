import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {Media as MediaEntity, MediaVisibility} from "../../entities/Media";
import {BaseService, BaseServiceConfiguration} from "../BaseService";
import {MediaUseCases} from "../../usecases/MediaUseCases";
import {NotAuthenticated, NotImplemented} from "@feathersjs/errors";
import {User as UserEntity, User} from "../../entities/User";
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
    throw new NotImplemented();
  }

  async get (id: Id, params?: Params): Promise<MediaDTO> {
    return await this.useCase.get(id.toString(), params?.user as User);
  }

  async create (data: MediaDTO, params?: Params): Promise<MediaDTO> {
    if(params && params.user && params.user as User)
      return this.useCase.create(data,params.user as User)
    throw new NotAuthenticated('User is not authenticated.');
  }

  async update (id: NullableId, data: MediaDTO, params?: Params): Promise<MediaDTO> {
    throw new NotImplemented();
  }

  async patch (id: NullableId, data: MediaDTO, params?: Params): Promise<MediaDTO> {
    throw new NotImplemented();
  }

  async remove (id: NullableId, params?: Params): Promise<MediaDTO> {
    throw new NotImplemented();
  }

  async isDataAuthorized(data: any, right: string, user: any): Promise<boolean> {
    const media = data as MediaEntity;
    if(media &&
      right === 'r' &&
      media.visibility === MediaVisibility.public) {
      return true
    } else {
      return this.useCase.isDataAuthorized(media, right, user);
    }
  }

  async needAuthentication(context: any): Promise<boolean> {
    await this.validAuthentication(context?.params, true);
    const executingUser:UserEntity = context?.user as UserEntity;
    if(context.method.toLowerCase() === 'get' || context.method.toLowerCase() === 'find') {
      if(context.id){
        if(isNumber(context.id)) {
          const data = await this.useCase.get(context.id, executingUser)
          if(data)
            return !(data.visibility === MediaVisibility.public);
        } else {
          const filtered = await this.useCase.find({ key: context.id.toString()}, executingUser)
          if(filtered && filtered.length > 0) {
            for(const m of filtered){
              if(m.visibility !== MediaVisibility.public)
                return false
            }
            return true;
          }
        }
      } else {
        if(context.params.query) {
          const filtered = await this.useCase.find(context.params.query, executingUser);
          if(filtered && filtered.length > 0) {
            for(const m of filtered){
              if(m.visibility !== MediaVisibility.public)
                return false
            }
            return true;
          }
        }
      }
    }
    return false;
  }
}
