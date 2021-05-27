import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {BaseService} from "../BaseService";
import {RoleUseCases} from "../../usecases/RoleUseCases";
import {NotAcceptable, NotFound} from "@feathersjs/errors";
import {User as UserEntity} from "@nodecms/backend-data";
import {Role as RoleEntity} from '@nodecms/backend-data';

type RoleDTO = Partial<RoleEntity>

interface ServiceOptions {
  paginate?:number
  storage: {
    contractName:string;
    configuration?:any
  }
}

export class Role extends BaseService<RoleDTO, RoleUseCases> {

  options: ServiceOptions;

  constructor (options: ServiceOptions = {
    storage:{
      contractName:'Default'
    }
  }, app: Application) {
    super(app,'role', 'Role', options);
    this.options = options;
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<RoleDTO[] | Paginated<RoleDTO>> {
    const executingUser:UserEntity = params?.user as UserEntity;
    if(params) {
      return await this.useCase.find(params.filter,undefined, executingUser)
    }
    return [];
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<RoleDTO> {
    try {
      const executingUser:UserEntity = params?.user as UserEntity;
      return await this.useCase.get(id, executingUser);
    }catch(error) {
      throw new NotFound(error.message);
    }
    throw new NotFound(`No role with id ${id}`);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async create (data: RoleDTO, params?: Params): Promise<RoleDTO> {
    const executingUser:UserEntity = params?.user as UserEntity;
    return await this.useCase.create(data, executingUser);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: RoleDTO, params?: Params): Promise<RoleDTO> {
    if(!id)
      throw new NotAcceptable('Please provide a correct id for update');
    const executingUser:UserEntity = params?.user as UserEntity;
    const existing = await this.get(id,params);
    if(!existing.id)
      throw new NotAcceptable('Please provide a correct id for update');
    return await this.useCase.update(existing.id, data, executingUser);
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
    const executingUser:UserEntity = params?.user as UserEntity;
    return await this.useCase.update(existing.id, data, executingUser);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async remove (id: NullableId, params?: Params): Promise<RoleDTO> {
    if(!id && id !== 0)
      throw new NotAcceptable('Please provide a correct id for delete');
    const executingUser:UserEntity = params?.user as UserEntity;
    return await this.useCase.delete(id, executingUser);
  }

  async needAuthentication(context: any): Promise<boolean> {
    return true;
  }

  async isDataAuthorized(data: any, right:string='r',user?:UserEntity):Promise< boolean> {
    return this.useCase.isDataAuthorized(data,right,user);
  }

}
