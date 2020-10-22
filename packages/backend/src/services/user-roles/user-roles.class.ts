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

type Data = Role

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
      const user:UserEntity = this.userUseCases.get(params.route.idOrLogin);
      return await this.userUseCases.getRoles(user);
    } catch(err) {
      throw new NotFound(err.message);
    }
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<Data> {
    if(!params || !params.route || !params.route.idOrLogin)
      throw new NotAcceptable(`No user id`);
    try {
      const user:UserEntity = this.userUseCases.get(params.route.idOrLogin);
      const role:Role = this.roleUseCases.get(id);
      if(await this.userUseCases.hasRole(user, role))
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
      const user:UserEntity = this.userUseCases.get(params.route.idOrLogin);
      let role:Role;
      if(isNumber(data)) {
        role = this.roleUseCases.get(parseInt(data.toString()));
      } else {
        role = await this.roleUseCases.find(data as Role)[0]
      }
      await this.userUseCases.hadRole(user, role);
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
      const user:UserEntity = this.userUseCases.get(params.route.idOrLogin);
      let role:Role;
      if(isNumber(id)) {
        role = this.roleUseCases.get(parseInt(id.toString()));
      } else {
        role = await this.roleUseCases.find({key:id.toString()})[0]
      }
      await this.userUseCases.hadRole(user, role);
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
      const user:UserEntity = this.userUseCases.get(params.route.idOrLogin);
      let role:Role;
      if(isNumber(id)) {
        role = this.roleUseCases.get(parseInt(id.toString()));
      } else {
        role = await this.roleUseCases.find({key:id.toString()})[0]
      }
      await this.userUseCases.removeRole(user, role);
      return role;
    } catch(err) {
      throw new Error(err.message);
    }
  }

  needAuthentication(context: any): boolean {
    return true
  }

  isAuthorized(context: any): Promise<boolean> {
    throw new Error("Method not implemented.");
  }

  async isDataAuthorized(data: any,right:string='r',user?:UserEntity):Promise< boolean> {
    throw new Error("Method not implemented.");
  }

}
