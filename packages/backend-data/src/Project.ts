import {Entity} from "./Entity";

export interface Project extends Entity {
    key:string
    label:string
    description:string
}