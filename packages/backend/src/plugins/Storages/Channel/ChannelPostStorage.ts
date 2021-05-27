import {ChannelPost} from "@nodecms/backend-data/ChannelPost";
import {Storage} from '../Storage';
import {Metadata} from "@nodecms/backend-data/Metadata";

export interface ChannelPostStorage extends Storage<ChannelPost> {
  exists(keyOrId:string | number, channelName?:string):Promise<boolean>;

  get(keyOrId:string | number, channelName?:string):Promise<ChannelPost>;

  find(filter? : Partial<ChannelPost>, lastIndex?:string | number, channelName?:string): Promise<ChannelPost[]>

  create(data: ChannelPost,channelName?:string): Promise<ChannelPost>;

  update(data: ChannelPost,channelName?:string): Promise<ChannelPost>;

  delete(keyOrId:string, channelName?:string):Promise<ChannelPost>;

}
