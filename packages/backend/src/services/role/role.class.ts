import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {BaseService} from "../BaseService";
import {RoleUseCases} from "../../usecases/RoleUseCases";
import {NotAcceptable, NotFound} from "@feathersjs/errors";
import {User as UserEntity} from "../../entities/User";

interface RoleDTO {
  id?:number;
  key:string;
  description?:string;
}

interface ServiceOptions {
  paginate?:number
  storage: {
    contractName:string;
    configuration?:any
  }
}

export class Role extends BaseService<RoleDTO> {

  options: ServiceOptions;
  private useCase: RoleUseCases;

  constructor (options: ServiceOptions = {
    storage:{
      contractName:'Default'
    }
  }, app: Application) {
    super(app,'role');
    this.options = options;
    this.useCase = new RoleUseCases(options);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<RoleDTO[] | Paginated<RoleDTO>> {
    if(params) {
      return this.useCase.find(params.filter)
    }
    return [];
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<RoleDTO> {
    try {
      return this.useCase.get(id);
    }catch(error) {
      throw new NotFound(error.message);
    }
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async create (data: RoleDTO, params?: Params): Promise<RoleDTO> {
    return await this.useCase.create(data);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: RoleDTO, params?: Params): Promise<RoleDTO> {
    if(!id)
      throw new NotAcceptable('Please provide a correct id for update');
    const existing = await this.get(id,params);
    if(!existing.id)
      throw new NotAcceptable('Please provide a correct id for update');
    return await this.useCase.update(existing.id, data);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async patch (id: NullableId, data: RoleDTO, params?: Params): Promise<RoleDTO> {
    if(!id)
      throw new NotAcceptable('Please provide a correct id for update');
    const existing = await this.get(id,params);
    data.id = existing.id;
    data.key = existing.key;
    if(!existing.id)
      throw new NotAcceptable('Please provide a correct id for update');
    return await this.useCase.update(existing.id, data);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async remove (id: NullableId, params?: Params): Promise<RoleDTO> {
    if(!id)
      throw new NotAcceptable('Please provide a correct id for delete');
    return await this.useCase.delete(id);
  }

  needAuthentication(context: any): boolean {
    return true;
  }

  async isDataAuthorized(data: any, right:string='r',user?:UserEntity):Promise< boolean> {
    return this.useCase.isDataAuthorized(data,right,user);
  }

}
