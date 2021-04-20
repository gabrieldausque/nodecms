import { writable } from "svelte/store";

export class Documents {
    documents:any[];
    hasNext:boolean
}

export const DocumentsStore = writable(new Documents())