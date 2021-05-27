import {Entity} from "@nodecms/backend-data/Entity";

export interface StorageConfiguration {
  pageSize?:number;
}

export abstract class Storage<T extends Entity> {

  pageSize?: number;
  configuration?: StorageConfiguration;

  constructor(configuration?:StorageConfiguration) {
    this.validateConfiguration(configuration);
    this.configuration = configuration;
    this.pageSize = configuration?.pageSize;
  }

  abstract exists(keyOrId:string | number | T):Promise<boolean>;

  abstract get(keyOrId:string | number):Promise<T>;

  abstract find(filter? : Partial<T>, lastIndex?:number): Promise<T[]>

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

  validateConfiguration(configuration:any):void {
    //Do nothing by default
  }
}
