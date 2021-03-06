import {MongoDbStorage} from "../MongoDbStorage";
import {Channel, isNumber, NotFoundError} from "@nodecms/backend-data";
import {ChannelStorage} from "./ChannelStorage";

export class MongoDbChannelStorage extends MongoDbStorage<Channel> implements ChannelStorage {

  public static metadata:any[] = [
    {
      contractType:'ChannelStorage',
      contractName:'MongoDb',
      isShared:true
    }
  ]

  async create(data: Channel): Promise<Channel> {
    if(!await this.exists(data.key)){
      const newChannel = {
        ...data,
        ...{ id: await this.getNewId() }
      }
      await this.internalCreate(newChannel);
    }
    return await this.get(data.key);
  }

  async delete(keyOrId: string | number | Channel): Promise<Channel> {
    if(await this.exists(keyOrId)){
      let usableId:number | null = null;
      if(isNumber(keyOrId)){
        usableId = parseInt(keyOrId.toString());
      } else if (typeof keyOrId === 'string'){
        const channel:Channel = await this.get(keyOrId);
        usableId = channel.id as number;
      } else {
        const channel = keyOrId as Channel;
        usableId = channel.id as number;
      }
      if(usableId !== null){
        const deleted = await this.get(usableId);
        await this.internalDelete(deleted);
        return deleted;
      }
    }
    throw new Error(`No Channel with key or id ${keyOrId}`)
  }

  async exists(keyOrId: string | number | Channel): Promise<boolean> {
    let channels:Channel[] = []
    if(isNumber(keyOrId)){
      channels = await this.find({
        id:parseInt(keyOrId.toString())
      })
    } else {
      channels = await this.find( {
        key:keyOrId.toString()
      })
    }
    return Array.isArray(channels) && channels.length > 0;
  }

  async find(filter: Partial<Channel> | undefined): Promise<Channel[]> {
    if(filter){
      return await this.internalFind(filter);
    }
    return await this.internalFind({});
  }

  async get(keyOrId: string | number): Promise<Channel> {
    let channel:Channel | null = null;
    if(isNumber(keyOrId)){
      channel = await this.internalGet(parseInt(keyOrId.toString()));
    } else {
      const found = await this.find({
        key:keyOrId.toString()
      });
      if(Array.isArray(found) && found.length > 0){
        channel = found[0];
      }
    }
    if(channel)
      return channel;
    throw new NotFoundError(`Channel with key or id ${keyOrId} doesn't exists`);
  }

  async update(data: Channel): Promise<Channel> {
    await this.internalUpdate(data);
    return await this.get(data.id as number);
  }

}
