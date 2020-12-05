import {MongoDbStorage} from "../MongoDbStorage";
import {MediaStorage} from "./MediaStorage";
import {Media} from "../../../entities/Media";

export class MongoDbMediaStorage extends MongoDbStorage<Media> implements MediaStorage {

  public static metadata:any[] = [
    {
      contractType:'MediaStorage',
      contractName:'MongoDb',
      isShared:true
    }
  ]
  
  async create(data: Media, collectionName?: string): Promise<Media> {
    throw new Error('Not Implemented')
  }

  delete(keyOrId: string | number | Media, collectionName?: string): Promise<Media> {
    throw new Error('Not Implemented')
  }

  exists(keyOrId: string | number | Media, collectionName?: string): Promise<boolean> {
    throw new Error('Not Implemented')
  }

  find(filter: Partial<Media> | undefined, collectionName?: string): Promise<Media[]> {
    throw new Error('Not Implemented')
  }

  get(keyOrId: string | number, collectionName?: string): Promise<Media> {
    throw new Error('Not Implemented')
  }

  update(data: Media, collectionName?: string): Promise<Media> {
    throw new Error('Not Implemented')
  }

}
