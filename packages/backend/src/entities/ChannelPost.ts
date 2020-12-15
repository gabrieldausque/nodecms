import {Entity} from "./Entity";
import {User} from "./User";

export interface ChannelPost extends Entity  {
  author?:number | Partial<User>,
  creationDate?: Date,
  channelKey?:string,
  parentPost?:number
  content:string,
  tags?:string[]
}
