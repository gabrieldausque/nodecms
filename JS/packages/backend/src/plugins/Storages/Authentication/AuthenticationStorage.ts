import {Storage} from '../Storage'
import {Authentication} from "@nodecms/backend-data";
import {Authorization} from "@nodecms/backend-data";

export interface AuthenticationStorage extends Storage<Authentication> {

  exists(keyOrId:string | number | Authentication):Promise<boolean>;

  get(keyOrId:string | number):Promise<Authentication>;

  find(filter? : Authorization): Promise<Authentication[]>

  create(data: Authorization): Promise<Authentication>;

  update(data: Authorization): Promise<Authentication>;

  delete(keyOrId:string | number):Promise<Authentication>;
}
