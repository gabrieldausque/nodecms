import {EntityRules} from "./EntityRules";
import {ChannelPost} from "@nodecms/backend-data";

export class ChannelPostRules extends EntityRules<ChannelPost> {

  async validate(post:Partial<ChannelPost>) {
    //TODO : sanitize content and tags
    if(!post.channelKey){
      throw new Error(`Post must have a associated channel`);
    }

    if(!post.content){
      throw new Error('Post must have a content !');
    }

    if(post.parentPost && typeof post.parentPost === 'string') {
      post.parentPost = parseInt(post.parentPost);
    }
  }

  async validateFilter(post:Partial<ChannelPost>) {

    if(post.parentPost && typeof post.parentPost === 'string') {
      post.parentPost = parseInt(post.parentPost);
    }
  }
}
