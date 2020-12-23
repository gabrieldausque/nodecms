import {Entity} from "./Entity";
import {User} from "./User";
import {Media} from "./Media";

export interface ChannelPost extends Entity  {
  author?:number | Partial<User>,
  creationDate?: Date,
  channelKey?:string,
  parentPost?:number
  content:string,
  attachments?: Partial<Media>[]
  tags?:string[]
}
