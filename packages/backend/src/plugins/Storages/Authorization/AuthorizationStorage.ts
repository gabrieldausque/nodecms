import {Entity, Storage} from "../Storage";

export interface Authorization extends Entity{
  id?: number
  on:string,
  onType:string,
  for?:string,
  right:string,
  role?:number
}

export interface AuthorizationStorage extends Storage<Authorization> {
  exists(keyOrId:string | number):boolean;

  get(keyOrId:string | number):Authorization;

  find(filter? : Authorization): Authorization[]

  create(data: Authorization): Promise<Authorization>;

  update(data: Authorization): Promise<Authorization>;

  delete(keyOrId:string | number):Promise<Authorization>;
}
