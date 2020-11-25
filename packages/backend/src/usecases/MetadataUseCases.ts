import {MetadataStorage} from "../plugins/Storages/Metadata/MetadataStorage";
import {MetadataEntityRules} from "../entities/MetadataEntityRules";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {UseCases} from "./UseCases";
import {Metadata} from "../entities/Metadata";

export interface MetadataUseCasesConfiguration extends UseCaseConfiguration {
}

export class MetadataUseCases extends UseCases<Metadata>  {

  public static metadata:any[] = [
    {
      contractType:'UseCases',
      contractName:'Metadata',
      isShared:true
    }
  ]

  constructor(configuration:MetadataUseCasesConfiguration = {
    storage: {
      contractName:'Default',
    }
  }) {
   super('metadata','MetadataStorage',configuration);
  }

  async get(id:string | number):Promise<Metadata> {
    const usableId = MetadataEntityRules.convertId(id);
    return await this.storage.get(usableId);
  }

  async find(filter: Metadata):Promise<Metadata[]> {
    MetadataEntityRules.convertFilter(filter);
    return await this.storage.find(filter);
  }

  async create(data: Metadata):Promise<Metadata> {
    //based on the data.key, a specific algorithm can be used to modify the way to store the value

    //default algo is here :
    MetadataEntityRules.convert(data);
    return this.storage.create(data);
  }

  async update(id: string | number, metadataToUpdate: Metadata):Promise<Metadata> {
    const usableId = MetadataEntityRules.convertId(id);
    const found = this.get(usableId)
    if(found) {
      const updatedMetadata = { ...found, ...metadataToUpdate}
      return await this.storage.update(updatedMetadata);
    }
    throw new Error(`No metadata with id ${id}. Update can't be done`);
  }

  async delete(id: string | number) {
    const usableId = MetadataEntityRules.convertId(id);
    return await this.storage.delete(usableId);
  }

}
