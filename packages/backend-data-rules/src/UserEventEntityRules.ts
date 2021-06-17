import {EntityRules} from "./EntityRules";
import {InvalidDataError, UserEvent} from "@nodecms/backend-data";

export class UserEventEntityRules extends EntityRules {

    static validateUserEvent(userEvent:UserEvent) {
        if(!userEvent.startDate ||
           !userEvent.endDate ||
            userEvent.startDate > userEvent.endDate)
        {
            throw new InvalidDataError('UserEvent must have a startDate and a endDate, with startDate > endDate. Please correct');
        }

        if(!Array.isArray(userEvent.attachment)){
            userEvent.attachments = [];
        }
    }

}