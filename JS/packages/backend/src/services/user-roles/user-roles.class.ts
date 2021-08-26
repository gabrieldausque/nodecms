import { Id, NullableId, Paginated, Params } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {BaseService, BaseServiceConfiguration} from "../BaseService";
import {globalInstancesFactory} from "@hermes/composition";
import {UserUseCases} from "../../usecases/UserUseCases";
import {NotAcceptable, NotFound} from "@feathersjs/errors";
import {RoleUseCases} from "../../usecases/RoleUseCases";
import {isNumber} from "@nodecms/backend-data";
import {Role} from "@nodecms/backend-data";
import {User as UserEntity} from "@nodecms/backend-data";
import {RoleEntityRules} from "@nodecms/backend-data-rules";

type RoleDTO = Partial<Role>;

interface ServiceOptions extends BaseServiceConfiguration {}

export class UserRoles extends BaseService<RoleDTO,
  RoleEntityRules,
  RoleUseCases> {

  app: Application;
  options: ServiceOptions;
  private userUseCases: UserUseCases;
  private roleUseCases: RoleUseCases;

  constructor (options: ServiceOptions = {
    storage:{
      contractName:'Default'
    }
  }, app: Application) {
    super(app, 'user-roles', 'Role', options);
    this.options = options;
    this.app = app;
    this.userUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','User');
    this.roleUseCases = this.useCase;
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<RoleDTO[] | Paginated<RoleDTO>> {
    if(!params || !params.route || !params.route.idOrLogin)
      throw new NotFound(`No user id`);
    try {
      const user:UserEntity = await this.userUseCases.get(params.route.idOrLogin);
      const executingUser:UserEntity = params?.user as UserEntity;
      return await this.userUseCases.getRoles(user, executingUser);
    } catch(err) {
      throw new NotFound(err.message);
    }
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<RoleDTO> {
    if(!params || !params.route || !params.route.idOrLogin)
      throw new NotAcceptable(`No user id`);
    try {
      const executingUser:UserEntity = params?.user as UserEntity;
      const user:UserEntity = await this.userUseCases.get(params.route.idOrLogin, executingUser);
      const role:Role = await this.roleUseCases.get(id, executingUser);
      if(await this.userUseCases.hasRole(user, role, executingUser))
        return role;
    } catch(err) {
      throw new NotFound(err.message);
    }
    throw new NotFound(`User ${params.route.idOrLogin} has no role ${id}`);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async create (data: RoleDTO, params?: Params): Promise<RoleDTO> {
    if(!params || !params.route || !params.route.idOrLogin)
      throw new NotAcceptable(`No user id`);
    try {
      const executingUser:UserEntity = params?.user as UserEntity;
      const user:UserEntity = await this.userUseCases.get(params.route.idOrLogin, executingUser);
      let role:Role;
      if(isNumber(data)) {
        role = await this.roleUseCases.get(parseInt(data.toString()), executingUser);
      } else {
        role = (await this.roleUseCases.find(data as Role, undefined, executingUser))[0]
      }
      await this.userUseCases.addRole(user, role, executingUser);
      return role;
    } catch(err) {
      throw new Error(err.message);
    }
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: RoleDTO, params?: Params): Promise<RoleDTO> {
    if(!params || !params.route || !params.route.idOrLogin)
      throw new NotAcceptable(`No user id`);
    if(!id && ! (typeof id === 'number'))
      throw new NotAcceptable(`No Role id to had`);
    try {
      const executingUser:UserEntity = params?.user as UserEntity;
      const user:UserEntity = await this.userUseCases.get(params.route.idOrLogin);
      let role:Role;
      if(isNumber(id)) {
        role = await this.roleUseCases.get(parseInt(id.toString()), executingUser);
      } else {
        role = (await this.roleUseCases.find({key:id.toString()}, undefined, executingUser))[0]
      }
      await this.userUseCases.addRole(user, role, executingUser);
      return role;
    } catch(err) {
      throw new Error(err.message);
    }
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async patch (id: NullableId, data: RoleDTO, params?: Params): Promise<RoleDTO> {
    return this.update(id,data,params);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async remove (id: NullableId, params?: Params): Promise<RoleDTO> {
    if(!params || !params.route || !params.route.idOrLogin)
      throw new NotAcceptable(`No user id`);
    if(!id && !(typeof id === 'number'))
      throw new NotAcceptable(`No Role id to had`);
    try {
      const user:UserEntity = await this.userUseCases.get(params.route.idOrLogin);
      const executingUser:UserEntity = params?.user as UserEntity;
      let role:Role;
      if(isNumber(id)) {
        role = await this.roleUseCases.get(parseInt(id.toString()), executingUser);
      } else {
        role = (await this.roleUseCases.find({key:id.toString()}, undefined, executingUser))[0]
      }
      await this.userUseCases.removeRole(user, role, executingUser);
      return role;
    } catch(err) {
      throw new Error(err.message);
    }
  }

  async needAuthentication(context: any): Promise<boolean> {
    return true
  }

  async isDataAuthorized(data: any,right:string='r',user?:UserEntity):Promise< boolean> {
    return this.roleUseCases.isDataAuthorized(data,right,user);
  }

}
