import {writable} from "svelte/store";

export class ChannelContent  {

    key:string;
    posts: any[];
    channel: any;

    constructor() {
        this.posts = []
    }

}