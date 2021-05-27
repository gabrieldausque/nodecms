import {MongoDbStorage, MongoDbStorageConfiguration} from "../MongoDbStorage";
import {MediaStorage} from "./MediaStorage";
import {Media, isNumber, MediaRules} from "@nodecms/backend-data";
import * as fs from "fs";
import {promisify} from 'util';
const writeFile = promisify(fs.writeFile);
const readFile = promisify(fs.readFile);
import {v4} from 'uuid';

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
      const path:string = `${this.fsStore}/${v4()}`;
      const createPromise = new Promise<void>((resolve, reject) => {
        const b:Uint8Array = new Uint8Array(data.blob as Buffer);
        fs.writeFile(path, b, (err) => {
          if(err)
            reject(err);
          else
            resolve()
        })
      })
      await createPromise;
      const newMedia:Media = {
        id: await this.getNewId(),
        key: data.key,
        visibility: data.visibility,
        label: data.label,
        mediaType: data.mediaType,
        ownerId: data.ownerId,
        storagePath: path,
        readers: data.readers,
        tags: data.tags
      }
      await this.internalCreate(newMedia);
    } else {
      throw new Error(`Media with key ${data.key} already exists.`)
    }
    return await this.get(data.key);
  }

  async delete(keyOrIdOrMedia: string | number | Media, collectionName?: string): Promise<Media> {
    this.checkFileStore();
    if(await this.exists(keyOrIdOrMedia)){
      let usableId:number|undefined;
      if(isNumber(keyOrIdOrMedia)) {
        usableId = MediaRules.convertId(keyOrIdOrMedia.toString())
      } else if (keyOrIdOrMedia as Media){
        usableId = (keyOrIdOrMedia as Media).id
      }
      if(typeof usableId === 'number'){
        const media = await this.get(usableId);
        media.blob = undefined;
        await this.internalDelete({
          id:media.id
        })
        const deletePromise = new Promise<void>((resolve, reject) => {
          fs.unlink(media.storagePath, (err) => {
            if(err)
              reject(err);
            else
              resolve()
          })
        })
        await deletePromise;
        return media;
      }
    }
    throw new Error(`Media with key ${keyOrIdOrMedia} doesn't exist.`)
  }

  async exists(keyOrIdOrMedia: string | number | Media, collectionName?: string): Promise<boolean> {
    this.checkFileStore();
    let media:Media[] = [];
    if(keyOrIdOrMedia || keyOrIdOrMedia === 0){
      if(isNumber(keyOrIdOrMedia)) {
        media = await this.find({
          id: parseInt(keyOrIdOrMedia.toString())
        })
      } else if (typeof keyOrIdOrMedia === 'string') {
        media = await this.find({
          key: keyOrIdOrMedia.toString()
        })
      } else if(keyOrIdOrMedia as Media){
        media = await this.find(keyOrIdOrMedia as Media);
      }
    }
    return Array.isArray(media) && media.length > 0;
  }

  async find(filter?: Partial<Media>, lastIndex?:number | string, collectionName?: string): Promise<Media[]> {
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

  async update(data: Media, collectionName?: string): Promise<Media> {
    await this.internalUpdate(data)
    return (await this.find({
      key: data.key
    }))[0];
  }

}
