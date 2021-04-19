import { writable } from "svelte/store";
import { Document } from "./DocumentStore";

export const EditableDocumentsStore = writable(new Document())