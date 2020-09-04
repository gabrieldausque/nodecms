import {Entity, Storage} from "../plugins/Storages/Storage";
import {globalInstancesFactory} from "@hermes/composition";

export interface useCaseConfiguration {
  storage: {
    contractName: string,
    configuration?: any
  }
}

export abstract class BaseUseCase<T extends Entity> {
  protected storage: Storage<T>;
  protected constructor(storageContractType:string,storageContractName:string, configuration:useCaseConfiguration) {
    this.storage = globalInstancesFactory.getInstanceFromCatalogs(storageContractType,storageContractName,configuration.storage.configuration);
  }
}
