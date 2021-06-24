import {writable} from 'svelte/store'
import type {UserEvent} from "@nodecms/backend-data";

export class UserEvents {
    startDate:Date;
    endDate:Date;
    eventsByUser: {
        [userLogin:string] : UserEvent[]
    }

    constructor() {
        this.eventsByUser = {};
        const now = new Date();
        this.startDate = new Date(now.getFullYear(), now.getMonth(),1,0,0,0);
        this.endDate = new Date(now.getFullYear(), now.getMonth(),1,23,59,59);
    }

}

export const UserEventsStore = writable(new UserEvents());