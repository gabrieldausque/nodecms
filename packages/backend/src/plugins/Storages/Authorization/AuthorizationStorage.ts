import {Storage} from "../Storage";
import {Authorization} from "../../../entities/Authorization";

export interface AuthorizationStorage extends Storage<Authorization> {
  exists(keyOrId:string | number):Promise<boolean>;

  get(keyOrId:string | number):Promise<Authorization>;

  find(filter? : Authorization): Promise<Authorization[]>

  create(data: Authorization): Promise<Authorization>;

  update(data: Authorization): Promise<Authorization>;

  delete(keyOrId:string | number):Promise<Authorization>;
}
