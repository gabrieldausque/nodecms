import {Storage} from "../Storage";
import {Authorization} from "../../../entities/Authorization";

export interface AuthorizationStorage extends Storage<Authorization> {
  exists(keyOrId:string | number):boolean;

  get(keyOrId:string | number):Authorization;

  find(filter? : Authorization): Authorization[]

  create(data: Authorization): Promise<Authorization>;

  update(data: Authorization): Promise<Authorization>;

  delete(keyOrId:string | number):Promise<Authorization>;
}
