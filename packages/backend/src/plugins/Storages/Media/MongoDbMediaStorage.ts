import {MongoDbStorage, MongoDbStorageConfiguration} from "../MongoDbStorage";
import {MediaStorage} from "./MediaStorage";
import {Media} from "../../../entities/Media";
import * as fs from "fs";
import {promisify} from 'util';
const writeFile = promisify(fs.writeFile);
const readFile = promisify(fs.readFile);
import {v4} from 'uuid';

import {isNumber} from "../../../helpers";

export interface MongoDbMediaStorageConfiguration extends MongoDbStorageConfiguration {
  fsStore:string
}

export class MongoDbMediaStorage extends MongoDbStorage<Media> implements MediaStorage {

  public static metadata:any[] = [
    {
      contractType:'MediaStorage',
      contractName:'MongoDb',
      isShared:true
    }
  ]

  fsStore:any;

  constructor(configuration:MongoDbMediaStorageConfiguration) {
    super(configuration);
    if(!configuration.fsStore)
      configuration.fsStore = 'uploads'
    this.fsStore = configuration.fsStore;
    this.checkFileStore();
  }

  private checkFileStore() {
    if (!fs.existsSync(`${this.fsStore}`)) {
      fs.mkdirSync(this.fsStore)
    }
  }

  async create(data: Media, collectionName?: string): Promise<Media> {
    this.checkFileStore();
    if(!data.blob)
      throw new Error('No file to save !')
    if(!await this.exists(data.key)) {
      const path:string = `${this.fsStore}/${v4()}`
      await writeFile(path, new Uint8Array(data.blob));
      const newMedia:Media = {
        id: await this.getNewId(),
        key: data.key,
        visibility: data.visibility,
        label: data.label,
        mediaType: data.mediaType,
        ownerId: data.ownerId,
        storagePath: path
      }
      await this.internalCreate(newMedia);
    } else {
      throw new Error(`Media with key ${data.key} already exists.`)
    }
    return await this.get(data.key);
  }

  delete(keyOrId: string | number | Media, collectionName?: string): Promise<Media> {
    this.checkFileStore();
    throw new Error('Not Implemented')
  }

  async exists(keyOrId: string | number | Media, collectionName?: string): Promise<boolean> {
    this.checkFileStore();
    let media:Media[] = [];
    if(isNumber(keyOrId)) {
      media = await this.find({
        id: parseInt(keyOrId.toString())
      })
    } else {
      media = await this.find({
        key: keyOrId.toString()
      })
    }
    return Array.isArray(keyOrId) && media.length > 0;
  }

  async find(filter: Partial<Media> | undefined, collectionName?: string): Promise<Media[]> {
    this.checkFileStore();
    if(filter) {
      if(filter.key) {
        return await this.internalFind({
          key: filter.key
        })
      } else {
        return await this.internalFind(filter);
      }
    }
    return [];
  }

  async get(keyOrId: string | number, collectionName?: string): Promise<Media> {
    this.checkFileStore();
    let media:Media | null = null;
    if(isNumber(keyOrId)){
      media = await this.internalGet(parseInt(keyOrId.toString()))
    } else {
      const filter = {
        key: keyOrId.toString()
      };
      const found = await this.find(filter);
      if(Array.isArray(found) && found.length > 0)
        media = found[0]
    }
    if(media)
    {
      media.blob = await readFile(media.storagePath);
      return media;
    }
    throw new Error(`No media with key or id ${keyOrId}.`)
  }

  update(data: Media, collectionName?: string): Promise<Media> {
    this.checkFileStore();
    throw new Error('Not Implemented')
  }

}
