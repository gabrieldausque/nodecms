import {MongoDbStorage} from "../MongoDbStorage";
import {Channel} from "../../../entities/Channel";
import {ChannelStorage} from "./ChannelStorage";
import {isNumber} from "../../../helpers";
import {Metadata} from "../../../entities/Metadata";

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
    throw new Error('Not implemented');
  }

  async exists(keyOrId: string | number | Channel): Promise<boolean> {
    let channel:Channel[] = []
    if(isNumber(keyOrId)){
      channel = await this.find({
        id:parseInt(keyOrId.toString())
      })
    } else {
      channel = await this.find( {
        key:keyOrId.toString()
      })
    }
    return Array.isArray(channel) && channel.length > 0;
  }

  async find(filter: Partial<Channel> | undefined): Promise<Channel[]> {
    if(filter){
      return await this.internalFind(filter);
    }
    return []
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
    throw new Error(`Channel with key or id ${keyOrId} doesn't exists`);
  }

  async update(data: Channel): Promise<Channel> {
    throw new Error('Not implemented');
  }

}
