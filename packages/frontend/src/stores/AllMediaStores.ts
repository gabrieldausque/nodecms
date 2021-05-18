import { writable } from "svelte/store";

export class AllMedia {

    private media: any[];

    constructor() {
        this.media = []
    }

}

export const AllMediaStores = writable(new AllMedia())