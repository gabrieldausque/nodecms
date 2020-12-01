import {EntityRules} from "./EntityRules";
import {Channel, ChannelVisibility} from "./Channel";

export class ChannelRules extends EntityRules {

  static validate(channel:Channel){
    if(channel.visibility !== ChannelVisibility.private &&
    channel.visibility !== ChannelVisibility.protected &&
    channel.visibility !== ChannelVisibility.public) {
      channel.visibility = ChannelVisibility.private;
    }

    channel.readers = channel.readers ?? [];
    channel.contributors = channel.contributors ?? [];
    channel.editors = channel.editors ?? [];
    channel.administrators = channel.administrators ?? [];
  }

}
