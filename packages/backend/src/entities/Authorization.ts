import {Entity} from "./Entity";

export interface Authorization extends Entity {
    id?: number
    on: string,
    onType: string,
    for?: string,
    right: string,
    role?: number
}
