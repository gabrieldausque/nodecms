import {writable} from 'svelte/store';

export class MediaUrlStorage {
    [mediaId:string] : string;
}

export const MediaUrlStore = writable(new MediaUrlStorage());