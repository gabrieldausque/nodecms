import {writable} from "svelte/store";

export class ChannelContent  {
    key:string;
    posts: any[];

    constructor() {
        this.posts = []
    }
}

export const ChannelStore = writable(new ChannelContent())