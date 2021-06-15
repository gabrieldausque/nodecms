import {writable} from "svelte/store";
import type {Channel} from '@nodecms/backend-data';

export class ChannelContent  {

    key:string;
    posts: any[];
    channel: any;

    constructor() {
        this.posts = []
    }

}

export class ChannelsCache {

    hasChannel(channelKey: string) {
        return this.hasOwnProperty(channelKey);
    }

    addChannel(channel:Channel) {
        if(!this.hasOwnProperty(channel.key)){
            const c = new ChannelContent();
            c.key = channel.key;
            c.channel = channel;
            this[channel.key] = c
        }
    }

}

export const channelsCache = new ChannelsCache();
export const observableChannelCache = writable(channelsCache);