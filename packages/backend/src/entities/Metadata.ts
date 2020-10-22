import {Entity} from "./Entity";

export interface Metadata extends Entity {
    id?: number;
    key: string;
    value?: any;
    isPublic?: boolean;
    ownerType?: string | null;
    ownerId?: number | null;
}
