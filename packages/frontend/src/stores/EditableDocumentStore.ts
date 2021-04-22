import { writable } from "svelte/store";
import { Document } from "./DocumentStore";

export const EditableDocumentStore = writable(new Document())