import { writable } from "svelte/store";

export class GenericDataStorage {
    data:any[];
    hasNext:boolean
}

export const observableGenericDataStore = writable(new GenericDataStorage())