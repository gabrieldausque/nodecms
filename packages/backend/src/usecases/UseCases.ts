import {Storage} from "../plugins/Storages/Storage";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {globalInstancesFactory} from "@hermes/composition";
import {Entity} from "../entities/Entity";
import {AuthorizationUseCases} from "./AuthorizationUseCases";
import {UserUseCases} from "./UserUseCases";
import {RoleUseCases} from "./RoleUseCases";
import {User} from "../entities/User";

export abstract class UseCases<T extends Entity> {
  public storage: Storage<T>;
  private readonly dataType: string;

  protected constructor(dataType:string, contractType:string, configuration:UseCaseConfiguration = {
    storage:{
      contractName:'Default'
    }
  }) {
    this.dataType = dataType;
    this.storage = globalInstancesFactory.getInstanceFromCatalogs(contractType, configuration.storage.contractName, configuration.storage.configuration);
  }

  abstract async get(id : string | number, executingUser?:User) : Promise<T>;
  abstract async find(filter:Partial<T>, lastIndex?:number | string, executingUser?:User) : Promise<T[]>;
  abstract async create(entity:T, executingUser?:User): Promise<T>;
  abstract async update(id: string | number, entityToUpdate:T, executingUser?:User): Promise<T>;
  abstract async delete(id: string | number, executingUser?:User): Promise<T>;

  async isDataAuthorized(data:Entity, right:string='r', user?:any):Promise<boolean> {
    const authorizationUseCase:AuthorizationUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'Authorization');
    const userUseCase:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'User');
    const roleUseCases:RoleUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Role');
    const authorizations = await authorizationUseCase.find({
      right:right,
      on:'data',
      onType:this.dataType,
      for:(data.id || data.id === 0)?data.id.toString():'*'
    }, undefined, user);
    for(const authorization of authorizations) {
      if(authorization.role || authorization.role === 0){
        const expectedRole = await roleUseCases.get(authorization.role, user);
        if(await userUseCase.hasRole(user, expectedRole, user))
          return true;
      }
    }
    return false;
  }
}
