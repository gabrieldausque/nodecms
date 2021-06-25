import {EntityRules} from "./EntityRules";
import {
    InvalidDataError,
    isNumber,
    UserAvailabilityStatus,
    UserEvent,
    UserEventVisibility
} from "@nodecms/backend-data";

export class UserEventEntityRules extends EntityRules<UserEvent> {

    async validateFilter(filter:Partial<UserEvent>) {
        if(filter.startDate && isNumber(filter.startDate)){
            filter.startDate = new Date(parseInt(filter.startDate.toString()));
        }

        if(filter.endDate && isNumber(filter.endDate)){
            filter.endDate = new Date(parseInt(filter.endDate.toString()));
        }

        if(typeof filter.ownerId === 'string'){
            filter.ownerId = parseInt(filter.ownerId);
        }
    }

    async validate(entity: Partial<UserEvent>): Promise<void> {

        if(!entity.startDate ||
            !entity.endDate ||
            entity.startDate > entity.endDate)
        {
            throw new InvalidDataError('UserEvent must have a startDate and a endDate, with startDate > endDate. Please correct');
        }

        if(typeof entity.startDate === 'string'){
            if(isNumber(entity.startDate)){
                entity.startDate = new Date(parseInt(entity.startDate));
            } else {
                entity.startDate = new Date(Date.parse(entity.startDate));
            }
        }

        if(typeof entity.endDate === 'string'){
            if(isNumber(entity.endDate)){
                entity.endDate = new Date(parseInt(entity.endDate));
            } else {
                entity.endDate = new Date(Date.parse(entity.endDate));
            }
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