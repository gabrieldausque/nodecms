import {Entity} from "./Entity";

export interface Role extends Entity {
    id?: number;
    key: string;
    description?: any;
}
