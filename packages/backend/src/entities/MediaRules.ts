import {EntityRules} from "./EntityRules";
import {Media, MediaVisibility} from "./Media";
import {User} from "./User";
import {Magic, MAGIC_CONTINUE, MAGIC_MIME_TYPE} from "mmmagic";


const magic = new Magic(MAGIC_MIME_TYPE);
const magicForContent = new Magic(MAGIC_CONTINUE);

export class MediaRules extends EntityRules{

  static getAuthorizedMimeTypes():string[]{
    return [
    'image/gif',
    'image/png',
    'image/jpeg',
    'image/bmp',
    'image/webp',
    'image/svg+xml',
    'audio/midi',
    'audio/mpeg',
    'audio/webm',
    'audio/ogg',
    'audio/aac',
    'audio/wav',
    'audio/3gpp',
    'audio/3gpp2',
    'video/3gpp2',
    'video/webm',
    'video/ogg',
    'video/mp4',
    'video/x-msvideo',
    'video/3gpp',
    'application/pdf'
  ]
}

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

    let p = new Promise<string>((resolve, reject) => {
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
    MediaRules.validateMimeType(ft);
    entity.mediaType = ft;
  }

  static validateMimeType(mimeTypeToTest: string) {
    if(MediaRules.getAuthorizedMimeTypes().indexOf(mimeTypeToTest) < 0){
      throw new Error(`Mime types ${mimeTypeToTest} is not authorized for upload`);
    }
  }
}
