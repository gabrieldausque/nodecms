import {MongoDbStorage, MongoDbStorageConfiguration} from "../MongoDbStorage";
import {ChannelPost, Channel, isNumber} from "@nodecms/backend-data";
import {ChannelPostStorage} from "./ChannelPostStorage";

export class MongoDbChannelPostStorage extends MongoDbStorage<ChannelPost> implements ChannelPostStorage {

  public static metadata:any[] = [
    {
      contractType:'ChannelPostStorage',
      contractName:'MongoDb',
      isShared:true
    }
  ]

  constructor(configuration:MongoDbStorageConfiguration) {
    super(configuration);
  }

  getCollectionNameFromChannelName(channelName?:string) {
    if(!channelName){
      throw new Error('No channel name for the post. Please specify which channel to post this one')
    }
    return `channel#${channelName}`
  }

  async create(data: Partial<ChannelPost>, channelName?:string): Promise<ChannelPost> {

    if(!channelName){
      throw new Error('No channel name for the current post');
    }
    const collectionName = this.getCollectionNameFromChannelName(channelName);
    let newId:number | null = null;
    if(!await this.exists(data.id as number, channelName)){
      newId = await this.getNewId(collectionName);
      let post = {
        ...data,
        ...{ id:  newId, creationDate: new Date()}
      }
      await this.internalCreate(post, collectionName);
    }
    if(isNumber(newId) && typeof newId === 'number')
      return await this.get(newId, channelName);
    throw new Error('No id created for the current post to be created');
  }

  delete(keyOrId: string | number | ChannelPost, channelName?:string): Promise<ChannelPost> {
    throw new Error('Not implemented')
  }

  async exists(keyOrId: string | number | ChannelPost, channelName?:string): Promise<boolean> {
    let posts:ChannelPost[] = []
    if(isNumber(keyOrId)){
      posts = await this.find({
        id:parseInt(keyOrId.toString())
      },undefined, channelName);
    } else if(keyOrId) {
      posts = await this.find( {
        key:keyOrId.toString()
      },undefined, channelName)
    }
    return Array.isArray(posts) && posts.length > 0;
  }

  async find(filter?: Partial<ChannelPost>, lastIndex?:number, channelName?:string): Promise<ChannelPost[]> {
    if(filter) {
      const collectionName = this.getCollectionNameFromChannelName(channelName);
      return await this.internalFind(filter,lastIndex, collectionName, true);
    }
    return []
  }

  async get(keyOrId: string | number, channelName?:string): Promise<ChannelPost> {
    let post:ChannelPost | null = null;
    const collectionName = this.getCollectionNameFromChannelName(channelName);
    if(isNumber(keyOrId)){
      post = await this.internalGet(parseInt(keyOrId.toString()), collectionName);
    } else {
      const found = await this.find({
        key:keyOrId.toString()
      },undefined, channelName);
      if(Array.isArray(found) && found.length > 0){
        post = found[0];
      }
    }
    if(post)
      return post;
    throw new Error(`Channel post with key or id ${keyOrId} doesn't exists`);
  }

  update(data: ChannelPost, channelName?:string): Promise<ChannelPost> {
    throw new Error('Not implemented')
  }

  validateConfiguration(configuration: MongoDbStorageConfiguration) {
    configuration.pageSize = (typeof configuration.pageSize === 'number')?
      configuration.pageSize:
      10;
  }

}
