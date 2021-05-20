import { writable } from "svelte/store";

export class BlockEditorComponent {
    component:any
    zone:string
}

export const BlockEditorComponentStore = writable(new BlockEditorComponent());