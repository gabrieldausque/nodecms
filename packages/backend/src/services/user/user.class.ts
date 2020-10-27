import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {BaseService} from '../BaseService';
import {globalInstancesFactory} from '@hermes/composition';
import {UserStorage} from '../../plugins/Storages/User/UserStorage'
import {NotAcceptable} from '@feathersjs/errors';
import {UserUseCases} from '../../usecases/UserUseCases';
import {User as UserEntity} from "../../entities/User";

interface UserDTO {
  id?:number
  login:string
  password:string
  isActive:boolean
}

interface ServiceOptions {
  paginate?:number
  storage:{
    contractName:string;
    configuration?:any
  }
}

export class User extends BaseService<UserDTO>  {

  options: ServiceOptions;
  useCase: UserUseCases

  needAuthentication(context: any): boolean {
    return true;
  }

  constructor (options: ServiceOptions = {
    storage:{
      contractName:'Default'
    }
  }, app: Application) {
    super(app, 'role');
    this.options = options;
    this.useCase = globalInstancesFactory.getInstanceFromCatalogs('UseCases','User', options);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<UserDTO[] | Paginated<UserDTO>> {
    if(params) {
      return this.useCase.find(params.filter);
    }
    return [];
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<UserDTO> {
    const user = this.useCase.get(id);
    user.password = '******';
    return user;
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async create (data: UserDTO, params?: Params): Promise<UserDTO> {
    return await this.useCase.create(data);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: UserDTO, params?: Params): Promise<UserDTO> {
    if(!id)
      throw new NotAcceptable('Please provide a correct id for update');
    const user = this.useCase.validate(data);
    return await this.useCase.update(id, user)
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async patch (id: NullableId, data: UserDTO, params?: Params): Promise<UserDTO> {
    return this.update(id, data, params);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async remove (id: NullableId, params?: Params): Promise<UserDTO> {
    if(!id)
      throw new NotAcceptable('Please provide a correct id for delete');
    return await this.useCase.delete(id);
  }

  async isDataAuthorized(data: any,right:string='r',user?:UserEntity):Promise< boolean> {
    return this.useCase.isDataAuthorized(data,right,user);
  }

}
