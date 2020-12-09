import {EntityRules} from "./EntityRules";
import {Media, MediaVisibility} from "./Media";
import {User} from "./User";
import {Magic, MAGIC_MIME_TYPE} from "mmmagic";


const magic = new Magic(MAGIC_MIME_TYPE);

export class MediaRules extends EntityRules{

  static async validate(entity: Partial<Media>, executingUser:User):Promise<void> {
    if(!entity.key)
      throw new Error('No key for the current file');

    if(!entity.blob)
      throw new Error('No file to upload.')

    if(!entity.visibility)
      entity.visibility = MediaVisibility.private;

    if(!entity.ownerId && entity.ownerId !== '0')
      entity.ownerId = executingUser.id?.toString();

    if(!entity.label)
      entity.label = entity.key

    const p = new Promise<string>((resolve, reject) => {
      if(entity.blob)
        magic.detect(entity.blob, (err, result) => {
          if(err)
            reject(err);
          else if(result)
          {
            if(Array.isArray(result))
              result = result[0]
            resolve(result);
          }
        })
      else
        reject(new Error('No file to upload.'))
    })

    let ft = await p;
    entity.mediaType = ft;
  }
}
