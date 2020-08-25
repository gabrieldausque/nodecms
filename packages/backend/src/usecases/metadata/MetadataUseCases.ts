import {globalInstancesFactory} from "@hermes/composition";
import {MetadataStorage} from "../../plugins/interfaces/MetadataStorage";

export class MetadataUseCases  {

  private storage: MetadataStorage;

  constructor(configuration:any = {
    storage: {
      contractName:'Default',
      configuration: null
    }
  }) {
   this.storage = globalInstancesFactory.getInstanceFromCatalogs('MetadataStorage', configuration.storage.contractName, configuration.storage.configuration);
  }
  get(key:string):any {
    return this.storage.get(key);
  }
}
