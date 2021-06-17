import {EntityRules} from "./EntityRules";
import {Channel, ChannelVisibility} from "@nodecms/backend-data";

export class ChannelRules extends EntityRules<Channel> {

  static validate(channel:Partial<Channel>){
    if(!channel.key){
      throw new Error('Channel must have a key. Please correct.')
    }

    if(!ChannelRules.isAuthorizedVisibility(channel.visibility)) {
      channel.visibility = ChannelVisibility.private;
    }
    channel.readers = channel.readers ?? [];
    channel.contributors = channel.contributors ?? [];
    channel.editors = channel.editors ?? [];
    channel.administrators = channel.administrators ?? [];
  }

  static isAuthorizedVisibility(visibility: string | undefined) {
    return (visibility === ChannelVisibility.private ||
      visibility === ChannelVisibility.protected ||
      visibility === ChannelVisibility.public);
  }
}
