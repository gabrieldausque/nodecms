import {EntityRules} from "./EntityRules";
import {InvalidDataError, UserAvailabilityStatus, UserEvent, UserEventVisibility} from "@nodecms/backend-data";

export class UserEventEntityRules extends EntityRules<UserEvent> {

    async validateFilter(filter:Partial<UserEvent>) {
        console.log(filter);
        if(typeof filter.startDate === 'string'){
            filter.startDate = new Date(Date.parse(filter.startDate));
        }

        if(typeof filter.endDate === 'string'){
            filter.endDate = new Date(Date.parse(filter.endDate));
        }

        if(typeof filter.ownerId === 'string'){
            filter.ownerId = parseInt(filter.ownerId);
        }

        console.log(filter)
    }

    async validate(entity: Partial<UserEvent>): Promise<void> {

        if(!entity.startDate ||
            !entity.endDate ||
            entity.startDate > entity.endDate)
        {
            throw new InvalidDataError('UserEvent must have a startDate and a endDate, with startDate > endDate. Please correct');
        }

        if(!Array.isArray(entity.attachment)){
            entity.attachments = [];
        }

        if(!UserAvailabilityStatus.isValidAvailability(entity.ownerAvailabilityStatus)){
            entity.ownerAvailabilityStatus = UserAvailabilityStatus.busy;
        }

        if(!UserEventVisibility.isValidVisibility(entity.visibility)){
            entity.visibility = UserEventVisibility.private;
        }

        if(!entity.color){
            entity.color = '#243dff';
        }
    }

}