import {Entity} from "../../entities/Entity";

export interface Storage<T extends Entity> {
  exists(keyOrId:string | number):Promise<boolean>;

  get(keyOrId:string | number):Promise<T>;

  find(filter? : T): Promise<T[]>

  create(data: T): Promise<T>;

  update(data: T): Promise<T>;

  delete(keyOrId:string | number):Promise<T>;
}
