import {Entity} from "../../entities/Entity";

export abstract class Storage<T extends Entity> {
  abstract exists(keyOrId:string | number | T):Promise<boolean>;

  abstract get(keyOrId:string | number):Promise<T>;

  abstract find(filter? : Partial<T>): Promise<T[]>

  abstract create(data: Partial<T>): Promise<T>;

  abstract update(data: Partial<T>): Promise<T>;

  abstract delete(keyOrId:string | number | T):Promise<T>;

  protected getIdFromParam(keyOrIdOrEntity: string | number | T) {
    let id:string;
    if(typeof keyOrIdOrEntity !== 'string' &&
      typeof keyOrIdOrEntity !== 'number' &&
      keyOrIdOrEntity.id){
      id = keyOrIdOrEntity.id.toString();
    } else {
      id = keyOrIdOrEntity.toString();
    }
    return id;
  }
}
