import {Entity} from "./Entity";

export interface ChannelPost extends Entity  {
  author?:number,
  channelKey?:string,
  parentPost?:number
  content:string,
  tags?:string[]
}
