import {MetadataStorage} from "../plugins/Storages/Metadata/MetadataStorage";
import {MetadataEntityRules} from "../entities/MetadataEntityRules";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {UseCases} from "./UseCases";
import {Metadata} from "../entities/Metadata";
import {User} from "../entities/User";
import {isNumber} from "../helpers";

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

  async get(id:string | number, executingUser:User):Promise<Metadata> {
    const usableId = MetadataEntityRules.convertId(id);
    return await this.storage.get(usableId);
  }

  async find(filter: Metadata, executingUser?:User):Promise<Metadata[]> {
    MetadataEntityRules.convertFilter(filter);
    return await this.storage.find(filter);
  }

  async create(data: Metadata, executingUser:User):Promise<Metadata> {
    //based on the data.key, a specific algorithm can be used to modify the way to store the value

    //default algo is here :
    MetadataEntityRules.convert(data);
    return this.storage.create(data);
  }

  async update(id: string | number, metadataToUpdate: Metadata, executingUser:User):Promise<Metadata> {
    let found:Metadata | null = null;
    if(isNumber(id)){
      const usableId = MetadataEntityRules.convertId(id);
      found = await this.get(usableId, executingUser)
    } else if(typeof id === 'string'){
      const filter = {  ...{key:id},...{
        id:metadataToUpdate.id,
        ownerType:metadataToUpdate.ownerType,
        ownerId:metadataToUpdate.ownerId
      }};
      const foundArray = await this.find(filter, executingUser);
      if(Array.isArray(foundArray) && foundArray.length > 0)
        found = foundArray[0];
    }
    if(found) {
      const updatedMetadata = { ...found, ...metadataToUpdate}
      return await this.storage.update(updatedMetadata);
    }
    throw new Error(`No metadata with id ${id}. Update can't be done`);
  }

  async delete(id: string | number, executingUser:User) {
    const usableId = MetadataEntityRules.convertId(id);
    const existing = await this.get(id,executingUser);
    existing.value = '';
    return await this.update(usableId, existing, executingUser);
  }

}
