import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import { WebThumbnail as WebThumbnailEntity } from "../../entities/WebThumbnail";
import {MethodNotAllowed, NotImplemented} from "@feathersjs/errors";
import {UserUseCases} from "../../usecases/UserUseCases";
import {globalInstancesFactory} from "@hermes/composition";
import {User as UserEntity} from '../../entities/User';
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
    throw new MethodNotAllowed();
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<WebThumbnailDTO> {
    return await this.useCase.createWebSiteThumbnail(id.toString())
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
      return userUseCase.isValidUser(user,user);
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

}
