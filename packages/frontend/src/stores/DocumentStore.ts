import { writable } from "svelte/store";

export class Document {
    key:string;
    document?: any;
}

export const DocumentStore = writable(new Document())