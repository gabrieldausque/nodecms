import { writable } from "svelte/store";

export class Document {
    key:string;
}

export const DocumentStore = writable(new Document())