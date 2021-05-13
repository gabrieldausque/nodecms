import { writable } from "svelte/store";

export class Media {

}

export class AllMedia {

    private medias: Media[];

    constructor() {
        this.medias = []
    }

}

export const AllMediaStores = writable(new AllMedia())