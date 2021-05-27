import {Storage} from '../Storage'
import {Metadata} from "@nodecms/backend-data";

export interface MetadataStorage extends Storage<Metadata> {
  exists(keyOrId:string | number, ownerType?:string | null, ownerId?:number | null):Promise<boolean>;

  get(keyOrId:string | number, ownerType?:string | null, ownerId?:number | null):Promise<Metadata>;

  find(filter? : Metadata): Promise<Metadata[]>

  create(data: Metadata): Promise<Metadata>;

  update(data: Metadata): Promise<Metadata>;

  delete(keyOrId:string | number, ownerType?:string | null, ownerId?:number | null):Promise<Metadata>;
}
