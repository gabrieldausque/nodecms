import {Storage} from "../plugins/Storages/Storage";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {globalInstancesFactory} from "@hermes/composition";
import {DocumentVisibility, Entity, NotAuthorizedError} from "@nodecms/backend-data";
import {AuthorizationUseCases} from "./AuthorizationUseCases";
import {UserUseCases} from "./UserUseCases";
import {RoleUseCases} from "./RoleUseCases";
import {User} from "@nodecms/backend-data";
import {DocumentRules, EntityRules, EntityRulesFactory} from "@nodecms/backend-data-rules";

export abstract class UseCases<T extends Entity, ER extends EntityRules<T>> {

  // @ts-ignore
  public storage: Storage<T>;
  private readonly dataType: string;
  protected readonly entityRules: ER;

  protected constructor(dataType:string,
                        contractType:string,
                        configuration:UseCaseConfiguration = {
    storage:{
      contractName:'Default'
    }
  }, noStorage:boolean = false, entityRulesClass: (new() => ER)) {
    this.dataType = dataType;
    const entityRulesFactory = new EntityRulesFactory();
    this.entityRules = entityRulesFactory.create<T, ER>(entityRulesClass);
    if(!noStorage)
      this.storage = globalInstancesFactory.getInstanceFromCatalogs(contractType, configuration.storage.contractName, configuration.storage.configuration);
  }

  async get(id : string | number, executingUser?:User) : Promise<T> {
    const entity = await this.storage.get(id);
    await this.entityRules.validateForRead(entity);
    if(await this.isDataAuthorized(entity,'r', executingUser))
      return entity;
    else
      throw new Error(`User ${executingUser?.login} is not authorized to access document with id ${entity.id}`);
  }

  async find(filter:Partial<T>, lastIndex?:number | string, executingUser?:User) : Promise<T[]> {
    let index:number | undefined = typeof lastIndex === 'string' ?
                       parseInt(lastIndex):lastIndex;
    const found = await this.storage.find(filter, index);
    for(const entity of found){
      await this.entityRules.validateForRead(entity);
    }
    return found;
  }

  async create(entity:T, executingUser?:User): Promise<T> {
    await this.entityRules.validate(entity)
    return await this.storage.create(entity);
  }

  async update(id: string | number, entityToUpdate:T, executingUser?:User): Promise<T> {
    const data = await this.get(id, executingUser);
    if(!await this.isDataAuthorized(data, 'w', executingUser))
      throw new NotAuthorizedError(`Update is not authorized for entity with id ${id} for entity with id ${id} for user ${executingUser?executingUser.login:'unknown'}`);
    else {
      await this.entityRules.validateForUpdate(entityToUpdate)
      return await this.storage.update(entityToUpdate);
    }
  }

  async delete(id: string | number, executingUser?:User): Promise<T> {
    const data = await this.get(id, executingUser);
    if(!await this.isDataAuthorized(data, 'w', executingUser))
      throw new NotAuthorizedError(`Delete is not authorized for entity with id ${id} for user ${executingUser?executingUser.login:'unknown'}`);
    return await this.storage.delete(id)
  }

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
