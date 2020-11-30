import {EntityRules} from "./EntityRules";
import {Channel, ChannelVisibility} from "./Channel";

export class ChannelRules extends EntityRules {

  validate(channel:Channel){
    if(channel.visibility !== ChannelVisibility.private ||
    channel.visibility !== ChannelVisibility.protected ||
    channel.visibility !== ChannelVisibility.public) {
      channel.visibility = ChannelVisibility.private;
    }
  }

}
