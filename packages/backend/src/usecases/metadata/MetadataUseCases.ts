import {globalInstancesFactory} from "@hermes/composition";
import {Metadata, MetadataStorage} from "../../plugins/Storages/Metadata/MetadataStorage";
import {MetadataEntity} from "../../entities/MetadataEntity";
import {User} from "../../plugins/Storages/User/UserStorage";
import {UserEntity} from "../../entities/UserEntity";

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

  get(key:string):any {
    return this.storage.get(key);
  }

  findAll(filter: Metadata) {
    MetadataEntity.validateFilter(filter);
    return this.storage.find(filter);
  }

  async create(data: Metadata):Promise<Metadata> {
    MetadataEntity.validateKey(data.key);
    return this.storage.create(data);
  }

  async update(id: string | number, metadataToUpdate: Metadata):Promise<Metadata> {
    const usableId = MetadataEntity.validateId(id);
    const found = this.findAll(metadataToUpdate);
    if(found.length > 0) {
      const existingMetadata = found[0]
      if(existingMetadata.id !== metadataToUpdate.id ||
        existingMetadata.key !== metadataToUpdate.key) {
        throw new Error('Only value, isPublic, ownerType and ownerId can be updated')
      }
      const updatedMetadata = { ...existingMetadata, ...metadataToUpdate}
      return await this.storage.update(updatedMetadata);
    }
  }
}
