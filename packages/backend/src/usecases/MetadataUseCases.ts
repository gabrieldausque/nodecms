import {globalInstancesFactory} from "@hermes/composition";
import {Metadata, MetadataStorage} from "../plugins/Storages/Metadata/MetadataStorage";
import {MetadataEntity} from "../entities/MetadataEntity";
import {User} from "../plugins/Storages/User/UserStorage";
import {UserEntity} from "../entities/UserEntity";

export interface MetadataUseCasesConfiguration {
  storage: {
    contractName:string,
    configuration?: any
  }
}

export class MetadataUseCases  {

  private storage: MetadataStorage;

  constructor(configuration:MetadataUseCasesConfiguration = {
    storage: {
      contractName:'Default',
    }
  }) {
   this.storage = globalInstancesFactory.getInstanceFromCatalogs('MetadataStorage',
     configuration.storage.contractName,
     configuration.storage.configuration);
  }

  get(id:string | number):any {
    const usableId = MetadataEntity.convertId(id);
    return this.storage.get(usableId);
  }

  find(filter: Metadata) {
    MetadataEntity.convertFilter(filter);
    return this.storage.find(filter);
  }

  async create(data: Metadata):Promise<Metadata> {
    MetadataEntity.convert(data);
    return this.storage.create(data);
  }

  async update(id: string | number, metadataToUpdate: Metadata):Promise<Metadata> {
    const usableId = MetadataEntity.convertId(id);
    const found = this.get(usableId)
    if(found) {
      const updatedMetadata = { ...found, ...metadataToUpdate}
      return await this.storage.update(updatedMetadata);
    }
    throw new Error(`No metadata with id ${id}. Update can't be done`);
  }

  async delete(id: string | number) {
    const usableId = MetadataEntity.convertId(id);
    return await this.storage.delete(usableId);
  }

}
