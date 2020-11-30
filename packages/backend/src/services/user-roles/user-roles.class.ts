import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {BaseService} from "../BaseService";
import {globalInstancesFactory} from "@hermes/composition";
import {UserUseCases} from "../../usecases/UserUseCases";
import {MetadataUseCases} from "../../usecases/MetadataUseCases";
import {MethodNotAllowed, NotAcceptable, NotFound, NotImplemented} from "@feathersjs/errors";
import {RoleUseCases} from "../../usecases/RoleUseCases";
import {isNumber} from "../../helpers";
import {Role} from "../../entities/Role";
import {User as UserEntity} from "../../entities/User";
import {exceptions} from "winston";

type Data = any

interface ServiceOptions {}

export class UserRoles extends BaseService<Data> {

  app: Application;
  options: ServiceOptions;
  private userUseCases: UserUseCases;
  private roleUseCases: RoleUseCases;

  constructor (options: ServiceOptions = {}, app: Application) {
    super(app, 'user-roles');
    this.options = options;
    this.app = app;
    this.userUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','User');
    this.roleUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Role');
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<Data[] | Paginated<Data>> {
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
  async get (id: Id, params?: Params): Promise<Data> {
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
  async create (data: Data, params?: Params): Promise<Data> {
    if(!params || !params.route || !params.route.idOrLogin)
      throw new NotAcceptable(`No user id`);
    try {
      const executingUser:UserEntity = params?.user as UserEntity;
      const user:UserEntity = await this.userUseCases.get(params.route.idOrLogin, executingUser);
      let role:Role;
      if(isNumber(data)) {
        role = await this.roleUseCases.get(parseInt(data.toString()), executingUser);
      } else {
        role = (await this.roleUseCases.find(data as Role, executingUser))[0]
      }
      await this.userUseCases.addRole(user, role, executingUser);
      return role;
    } catch(err) {
      throw new Error(err.message);
    }
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: Data, params?: Params): Promise<Data> {
    if(!params || !params.route || !params.route.idOrLogin)
      throw new NotAcceptable(`No user id`);
    if(!id)
      throw new NotAcceptable(`No Role id to had`);
    try {
      const executingUser:UserEntity = params?.user as UserEntity;
      const user:UserEntity = await this.userUseCases.get(params.route.idOrLogin);
      let role:Role;
      if(isNumber(id)) {
        role = await this.roleUseCases.get(parseInt(id.toString()), executingUser);
      } else {
        role = (await this.roleUseCases.find({key:id.toString()}, executingUser))[0]
      }
      await this.userUseCases.addRole(user, role, executingUser);
      return role;
    } catch(err) {
      throw new Error(err.message);
    }
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async patch (id: NullableId, data: Data, params?: Params): Promise<Data> {
    return this.update(id,data,params);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async remove (id: NullableId, params?: Params): Promise<Data> {
    if(!params || !params.route || !params.route.idOrLogin)
      throw new NotAcceptable(`No user id`);
    if(!id)
      throw new NotAcceptable(`No Role id to had`);
    try {
      const user:UserEntity = await this.userUseCases.get(params.route.idOrLogin);
      const executingUser:UserEntity = params?.user as UserEntity;
      let role:Role;
      if(isNumber(id)) {
        role = await this.roleUseCases.get(parseInt(id.toString()), executingUser);
      } else {
        role = (await this.roleUseCases.find({key:id.toString()}, executingUser))[0]
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
