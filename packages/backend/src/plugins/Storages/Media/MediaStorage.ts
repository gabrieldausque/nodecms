import {Storage} from '../Storage'
import {Media} from "@nodecms/backend-data/Media";

export interface MediaStorage extends Storage<Media> {

  exists(keyOrId:string | number):Promise<boolean>;

  get(keyOrId:string | number):Promise<Media>;

  find(filter? : Media): Promise<Media[]>

  create(data: Media): Promise<Media>;

  update(data: Media): Promise<Media>;

  delete(keyOrId:string | number):Promise<Media>;

}
