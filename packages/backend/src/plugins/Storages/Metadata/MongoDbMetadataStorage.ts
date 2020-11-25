import {MongoDbStorage, MongoDbStorageConfiguration} from "../MongoDbStorage";
import {Metadata} from "../../../entities/Metadata";

export class MongoDbMetadataStorage extends MongoDbStorage<Metadata> {

  public static metadata:any[] = [
    {
      contractType:'MetadataStorage',
      contractName:'CSV',
      isShared:true
    }
  ]

  constructor(configuration:MongoDbStorageConfiguration) {
    super(configuration);
  }

  create(data: Metadata): Promise<Metadata> {
    throw new Error('Not implemented')
  }

  delete(keyOrId: string | number | Metadata): Promise<Metadata> {
    throw new Error('Not implemented')
  }

  exists(keyOrId: string | number | Metadata): Promise<boolean> {
    throw new Error('Not implemented')
  }

  find(filter: Metadata | undefined): Promise<Metadata[]> {
    throw new Error('Not implemented')
  }

  get(keyOrId: string | number): Promise<Metadata> {
    throw new Error('Not implemented')
  }

  update(data: Metadata): Promise<Metadata> {
    throw new Error('Not implemented')
  }

}
