import {Entity} from "./Entity";

export interface User extends Entity{
    id?: number;
    login: string;
    password: string;
    isActive: boolean;
}
