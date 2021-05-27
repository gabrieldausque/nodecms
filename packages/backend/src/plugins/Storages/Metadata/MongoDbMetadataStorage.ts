import {MongoDbStorage, MongoDbStorageConfiguration} from "../MongoDbStorage";
import {Metadata, isNumber} from "@nodecms/backend-data";

export class MongoDbMetadataStorage extends MongoDbStorage<Metadata> {

  public static metadata:any[] = [
    {
      contractType:'MetadataStorage',
      contractName:'MongoDb',
      isShared:true
    }
  ]

  constructor(configuration:MongoDbStorageConfiguration) {
    super(configuration);
  }

  async create(data: Metadata): Promise<Metadata> {
    if(!await this.exists(data.key, data.ownerType,data.ownerId)) {
      const newMetadata:Metadata = {
        id: await this.getNewId(),
        key: data.key,
        value: data.value,
        isPublic: data.isPublic,
        ownerType: (data.ownerType)?data.ownerType:"",
        ownerId: (isNumber(data.ownerId))?data.ownerId:null
      }
      await this.internalCreate(newMetadata);
    }
    return await this.get(data.key, data.ownerType, data.ownerId);
  }

  async delete(keyOrIdOrMetadata: string | number | Metadata, ownerType?: string | null, ownerId?: number | null): Promise<Metadata> {
    let metadata:Metadata;
    if(typeof keyOrIdOrMetadata === 'number' || typeof keyOrIdOrMetadata === 'string'){
      metadata = await this.get(keyOrIdOrMetadata, ownerType, ownerId)
    } else {
      metadata = keyOrIdOrMetadata
    }
    if(metadata){
      await this.internalDelete(metadata);
    }
    return metadata
  }

  async exists(keyOrId: string | number , ownerType?: string | null, ownerId?: number | null): Promise<boolean> {
    let metadata:Metadata[] = [];
    if(isNumber(keyOrId)) {
      metadata = await this.find({
        id:parseInt(keyOrId.toString())
      })
    } else {
      metadata = await this.find({
        key: keyOrId.toString(),
        ownerType: ownerType,
        ownerId: ownerId
      })
    }
    return Array.isArray(metadata) && metadata.length > 0;
  }

  async find(filter: Partial<Metadata> | undefined): Promise<Metadata[]> {
    if(filter) {
      if(filter.key) {
        if(!filter.ownerType){
          filter.ownerType = '';
        }
        if(!filter.ownerId && filter.ownerId !== 0){
          filter.ownerId = null;
        }
      }
      return await this.internalFind({
        key:filter.key,
        ownerType: filter.ownerType,
        ownerId: filter.ownerId
      });
    }
    return [];
  }

  async get(keyOrId:string | number, ownerType:string |null = '', ownerId:number | null = null): Promise<Metadata> {
    let metadata:Metadata | null = null;
    if(isNumber(keyOrId)){
      metadata = await this.internalGet(parseInt(keyOrId.toString()))
    } else {
      const filter = {
        key:keyOrId.toString(),
        ownerType: ownerType,
        ownerId: ownerId
      };
      const found = await this.find(filter);
      if(Array.isArray(found) && found.length > 0)
        metadata = found[0];
    }
    if(metadata)
      return metadata;
    throw new Error(`Metadata with key or id ${keyOrId} doesn't exists`)
  }

  async update(data: Metadata): Promise<Metadata> {
    await this.internalUpdate(data)
    return await this.get(data.key, data.ownerType, data.ownerId);
  }

}
