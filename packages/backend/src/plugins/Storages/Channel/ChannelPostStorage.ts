import {ChannelPost} from "../../../entities/ChannelPost";
import {Storage} from '../Storage';
import {Metadata} from "../../../entities/Metadata";

export interface ChannelPostStorage extends Storage<ChannelPost> {
  exists(keyOrId:string | number, channelName?:string):Promise<boolean>;

  get(keyOrId:string | number, channelName?:string):Promise<ChannelPost>;

  find(filter? : Partial<ChannelPost>,channelName?:string): Promise<ChannelPost[]>

  create(data: ChannelPost,channelName?:string): Promise<ChannelPost>;

  update(data: ChannelPost,channelName?:string): Promise<ChannelPost>;

  delete(keyOrId:string, channelName?:string):Promise<ChannelPost>;

}