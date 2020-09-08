import {Storage} from '../Storage'

export interface Role {
  id?:number;
  key:string;
  description?:any;
}

export interface RoleStorage extends Storage<Role> {
  exists(keyOrId:string | number):boolean;

  get(keyOrId:string | number):Role;

  find(filter? : Role): Role[]

  create(data: Role): Promise<Role>;

  update(data: Role): Promise<Role>;

  delete(keyOrId:string | number):Promise<Role>;
}
