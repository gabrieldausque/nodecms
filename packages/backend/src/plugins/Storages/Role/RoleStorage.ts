import {Storage} from '../Storage'
import {Role} from "../../../entities/Role";

export interface RoleStorage extends Storage<Role> {
  exists(keyOrId:string | number):boolean;

  get(keyOrId:string | number):Role;

  find(filter? : Role): Role[]

  create(data: Role): Promise<Role>;

  update(data: Role): Promise<Role>;

  delete(keyOrId:string | number):Promise<Role>;
}
