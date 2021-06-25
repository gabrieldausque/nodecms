import {BaseServiceClient} from "./BaseServiceClient";
import {UserEvent} from "@nodecms/backend-data";

export class UserEventService extends BaseServiceClient<UserEvent> {
    constructor(url:string) {
        super(url, 'user-events');
    }

    async getUserEvent(id:number) {
        return await this.get(id);
    }

    async findUserEvents(ownerId:number, startDate:Date, endDate:Date) {
        return await this.find({
            ownerId:ownerId,
            startDate:startDate,
            endDate:endDate
        })
    }

    makeReadable(entity: UserEvent): UserEvent {
        if(typeof (entity as any).startDate === 'string'){
            entity.startDate = new Date(entity.startDate);
        }
        if(typeof (entity as any).endDate === 'string'){
            entity.endDate = new Date(entity.endDate);
        }
        return entity
    }
}