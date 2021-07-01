import {MetadataStorage} from "../plugins/Storages/Metadata/MetadataStorage";
import {MetadataEntityRules} from "@nodecms/backend-data-rules";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {UseCases} from "./UseCases";
import {Metadata} from "@nodecms/backend-data";
import {User} from "@nodecms/backend-data";
import {isNumber} from "@nodecms/backend-data";

export interface MetadataUseCasesConfiguration extends UseCaseConfiguration {
}

export class MetadataUseCases extends UseCases<Metadata, MetadataEntityRules>  {

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
   super(
     'metadata',
     'MetadataStorage',
     configuration,
     false,
     MetadataEntityRules);
  }

  async get(id:string | number, executingUser?:User):Promise<Metadata> {
    const usableId = this.entityRules.convertId(id);
    return await this.storage.get(usableId);
  }

  async find(filter: Partial<Metadata>, lastIndex?:number, executingUser?:User):Promise<Metadata[]> {
    this.entityRules.convertFilter(filter);
    return await this.storage.find(filter, lastIndex);
  }

  async create(data: Partial<Metadata>, executingUser:User):Promise<Metadata> {
    //based on the data.key, a specific algorithm can be used to modify the way to store the value

    //default algo is here :
    this.entityRules.convert(data);
    return this.storage.create(data);
  }

  async update(id: string | number, metadataToUpdate: Partial<Metadata>, executingUser:User):Promise<Metadata> {
    let found:Metadata | null = null;
    if(isNumber(id)){
      const usableId = this.entityRules.convertId(id);
      found = await this.get(usableId, executingUser)
    } else if(typeof id === 'string'){
      const filter = {  ...{key:id},...{
        id:metadataToUpdate.id,
        ownerType:metadataToUpdate.ownerType,
        ownerId:metadataToUpdate.ownerId
      }};
      const foundArray = await this.find(filter,undefined, executingUser);
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
    const usableId = this.entityRules.convertId(id);
    const existing = await this.get(id,executingUser);
    existing.value = '';
    return await this.update(usableId, existing, executingUser);
  }

}
