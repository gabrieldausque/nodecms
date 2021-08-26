import { writable } from "svelte/store";

export class BlockEditorComponent {
    component:any
    zone:string
    layout:string
}

export const BlockEditorComponentStore = writable(new BlockEditorComponent());