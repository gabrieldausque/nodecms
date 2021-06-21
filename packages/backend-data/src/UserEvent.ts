import {Entity} from "./Entity";

export const UserEventVisibility = {
    protected:"protected",
    private:"private"
}

export const UserAvailabilityStatus = {
    busy: "busy",
    available: "available"
}

export interface UserEvent extends Entity {
    startDate: Date,
    endDate: Date,
    category: string,
    ownerId: number,
    ownerAvailabilityStatus: string,
    visibility: string,
    label: string,
    description: string,
    location: string,
    attachments: number[]
}