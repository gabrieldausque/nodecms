import {BaseServiceClient} from "./BaseServiceClient";
import {UserEvent} from "@nodecms/backend-data";

export class UserEventService extends BaseServiceClient<UserEvent> {
    constructor(url:string) {
        super(url, 'user-events');
    }

    async getUserEvent(id:number) {
        return await this.get(id);
    }

    async findMyUserEvents(ownerId:number, startDate:Date, endDate:Date) {
        return await this.find({
            ownerId:ownerId,
            startDate:startDate,
            endDate:endDate
        })
    }
}