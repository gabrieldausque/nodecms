import {Entity} from "../../entities/Entity";

export interface Storage<T extends Entity> {
  exists(keyOrId:string | number):boolean;

  get(keyOrId:string | number):T;

  find(filter? : T): T[]

  create(data: T): Promise<T>;

  update(data: T): Promise<T>;

  delete(keyOrId:string | number):Promise<T>;
}
