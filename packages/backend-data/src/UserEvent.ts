import {Entity} from "./Entity";

export const UserEventVisibility = {
    protected:"protected",
    private:"private",
    isValidVisibility(visibility?:string){
        return visibility === this.protected ||
            visibility === this.private;
    }
}

export const UserAvailabilityStatus = {
    busy: "busy",
    available: "available",
    isValidAvailability(ownerAvailabilityStatus?: string): boolean {
        return ownerAvailabilityStatus === this.busy ||
            ownerAvailabilityStatus === this.available
    }
}

export interface UserEvent extends Entity {
    startDate: Date,
    endDate: Date,
    category: string,
    ownerId?: number,
    ownerAvailabilityStatus: string,
    visibility: string,
    label: string,
    description: string,
    location: string,
    color: string,
    attachments?: number[]
}