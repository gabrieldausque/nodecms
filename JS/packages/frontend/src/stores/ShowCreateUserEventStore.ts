import {writable} from 'svelte/store'
import type {UserEvent} from "@nodecms/backend-data";

export class ShowModalUserEvent {
    shown:boolean;
    startDate:Date;
    endDate:Date;
    userEvent?:UserEvent;

    constructor() {
        const today = new Date();
        this.shown = false;
        this.startDate = new Date(today.getFullYear(), today.getMonth(), today.getDate(), 0,0);
        this.endDate = new Date(today.getFullYear(), today.getMonth(), today.getDate(), 23,59);
    }
}

export const ShowCreateUserEventStore = writable(new ShowModalUserEvent());
export const ShowUpdateUserEventStore = writable(new ShowModalUserEvent());