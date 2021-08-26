import {writable} from 'svelte/store';
import {v4 as uuid} from 'uuid';

export class ShowUploadModal {
    shown: boolean;
    newId: string;

    constructor() {
        this.shown = false;
        this.newId = uuid()
    }
}

export const ShowUploadModalStore = writable(new ShowUploadModal());