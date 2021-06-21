import {writable} from 'svelte/store'

export class ShowCreateUserEvent {
    shown:boolean

    constructor() {
        this.shown = false;
    }
}

export const ShowCreateUserEventStore = writable(new ShowCreateUserEvent());