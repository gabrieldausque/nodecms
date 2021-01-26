import {Entity} from "./Entity";

export interface Role extends Entity {
    id?: number;
    key: string;
    description?: any;
    members?: number[];
    ownerId?: number;
    ownerRoles?: number[];
    creationDate?: Date
}
