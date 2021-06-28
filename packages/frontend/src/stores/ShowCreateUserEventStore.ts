import {writable} from 'svelte/store'

export class ShowModalUserEvent {
    shown:boolean;
    startDate:Date;
    endDate:Date;

    constructor() {
        const today = new Date();
        this.shown = false;
        this.startDate = new Date(today.getFullYear(), today.getMonth(), today.getDate(), 0,0);
        this.endDate = new Date(today.getFullYear(), today.getMonth(), today.getDate(), 23,59);
    }
}

export const ShowCreateUserEventStore = writable(new ShowModalUserEvent());
export const ShowUpdateUserEventStore = writable(new ShowModalUserEvent());