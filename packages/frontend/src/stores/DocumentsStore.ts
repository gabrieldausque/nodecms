import { writable } from "svelte/store";

export class Documents {
    documents:any[];
}

export const DocumentsStore = writable(new Documents())