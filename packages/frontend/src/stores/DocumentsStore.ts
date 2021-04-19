import { writable } from "svelte/store";

export class Documents {
    Documents:any[];
}

export const DocumentsStore = writable(new Documents())