import {writable} from 'svelte/store';

export class PostWithChildren  {
    parentPost:any;
    posts: any[];

    constructor() {
        this.posts = []
    }
}
