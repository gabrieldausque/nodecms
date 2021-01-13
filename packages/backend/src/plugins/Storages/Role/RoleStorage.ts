import {Storage} from '../Storage'
import {Role} from "../../../entities/Role";

export interface RoleStorage extends Storage<Role> {
  exists(keyOrId:string | number):Promise<boolean>;

  get(keyOrId:string | number):Promise<Role>;

  find(filter? : Partial<Role>): Promise<Role[]>

  create(data: Role): Promise<Role>;

  update(data: Role): Promise<Role>;

  delete(keyOrId:string | number):Promise<Role>;
}
