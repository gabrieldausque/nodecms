import {EntityRules} from "./EntityRules";
import {InvalidDataError, UserAvailabilityStatus, UserEvent, UserEventVisibility} from "@nodecms/backend-data";

export class UserEventEntityRules extends EntityRules<UserEvent> {

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