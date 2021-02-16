import {Entity} from "./Entity";

export interface Authentication extends Entity {
  login?:string,
  password?:string
  encryptedToken?:string
  clientUniqueId?:string
}
