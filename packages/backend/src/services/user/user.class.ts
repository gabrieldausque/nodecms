import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {BaseService, BaseServiceConfiguration} from '../BaseService';
import {NotAcceptable} from '@feathersjs/errors';
import {UserUseCases} from '../../usecases/UserUseCases';
import {User as UserEntity} from "@nodecms/backend-data";
import {UserEntityRules} from "@nodecms/backend-data-rules";

export type UserDTO = Partial<UserEntity>

interface ServiceOptions extends BaseServiceConfiguration {
}

export class User extends BaseService<UserDTO,
  UserEntityRules,
  UserUseCases>  {

  options: ServiceOptions;

  async needAuthentication(context: any): Promise<boolean> {
    return true;
  }

  constructor (options: ServiceOptions = {
    storage:{
      contractName:'Default'
    }
  }, app: Application) {
    super(app, 'user','User', options);
    this.options = options;
  }

  async find (params?: Params): Promise<UserDTO[] | Paginated<UserDTO>> {
    if(params) {
      const executingUser:UserEntity = params?.user as UserEntity;
      if(params.query){
        const found = await this.useCase.find(params.query as UserDTO,undefined, executingUser);
        for(const u of found){
          this.useCase.secureUserForExternal(u);
        }
        return found;
      }
    }
    return [];
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<UserDTO> {
    const executingUser:UserEntity = params?.user as UserEntity;
    let user:UserEntity = await this.useCase.get(id, executingUser);
    if(params &&
       params.query &&
       params.query.currentUser
    ){
      user = executingUser;
    }
    return this.useCase.secureUserForExternal(user);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async create (data: UserDTO, params?: Params): Promise<UserDTO> {
    const executingUser:UserEntity = params?.user as UserEntity;
    const user = await this.useCase.create(data, executingUser);
    return this.useCase.secureUserForExternal(user);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: UserDTO, params?: Params): Promise<UserDTO> {
    if(!id)
      throw new NotAcceptable('Please provide a correct id for update');
    const executingUser:UserEntity = params?.user as UserEntity;
    let user = this.useCase.validate(data);
    user = await this.useCase.update(id, user, executingUser);
    return this.useCase.secureUserForExternal(user);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async patch (id: NullableId, data: UserDTO, params?: Params): Promise<UserDTO> {
    return this.update(id, data, params);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async remove (id: NullableId, params?: Params): Promise<UserDTO> {
    if(!id)
      throw new NotAcceptable('Please provide a correct id for delete');
    const executingUser:UserEntity = params?.user as UserEntity;
    const user = await this.useCase.delete(id, executingUser);
    return this.useCase.secureUserForExternal(user);
  }

  async isDataAuthorized(data: any,right:string='r',user?:UserEntity):Promise< boolean> {
    return this.useCase.isDataAuthorized(data,right,user);
  }

}
