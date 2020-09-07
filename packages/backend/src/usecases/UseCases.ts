import {Entity, Storage} from "../plugins/Storages/Storage";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {globalInstancesFactory} from "@hermes/composition";

export abstract class UseCases<T extends Entity> {
  protected storage: Storage<T>;

  protected constructor(contractType:string, configuration:UseCaseConfiguration = {
    storage:{
      contractName:'Default'
    }
  }) {
    this.storage = globalInstancesFactory.getInstanceFromCatalogs(contractType, configuration.storage.contractName, configuration.storage.configuration);
  }

  abstract get(id : string | number) : T;
  abstract find(filter:T) : T[];
  abstract async create(entity:T): Promise<T>;
  abstract async update(id: string | number, entityToUpdate:T): Promise<T>;
  abstract async delete(id: string | number): Promise<T>;
}
