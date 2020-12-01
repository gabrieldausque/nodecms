import {EntityRules} from "./EntityRules";
import {ChannelPost} from "./ChannelPost";

export class ChannelPostRules extends EntityRules {
  static validate(post:ChannelPost) {
    //TODO : sanitize content and tags
    if(!post.channelKey){
      throw new Error(`Post must have a associated channel`);
    }
  }
}
