import {Entity} from "./Entity";

export interface Authentication extends Entity {
  login?:string,
  password?:string
}
