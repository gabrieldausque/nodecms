import {UseCases} from "./UseCases";
import {Media} from "../entities/Media";
import {User} from "../entities/User";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {MediaRules} from "../entities/MediaRules";
import {MediaStorage} from "../plugins/Storages/Media/MediaStorage";

export interface MediaUseCasesConfiguration extends UseCaseConfiguration {
  storage: {
    contractName:string,
    fsStore:string
  }
}

export class MediaUseCases extends UseCases<Media> {

  public static metadata:any[] = [
    {
      contractType:'UseCases',
      contractName:'Media',
      isShared:true
    }
  ]

  private blobStore:any;
  private mediaStorage: MediaStorage;

  constructor(configuration:MediaUseCasesConfiguration = {
    storage: {
      contractName:'Default',
      fsStore:'uploads'
    }
  }) {
    super('media','MediaStorage',configuration);
    this.mediaStorage = this.storage as MediaStorage;
  }

  async create(entity: Partial<Media>, executingUser: User): Promise<Media> {
    await MediaRules.validate(entity, executingUser);
    return await this.storage.create(entity);
  }

  async delete(id: string | number, executingUser: User): Promise<Media> {
    throw new Error('Not Implemented');
  }

  async find(filter: Partial<Media>, executingUser: User | undefined): Promise<Media[]> {
    throw new Error('Not Implemented');
  }

  async get(id: string | number, executingUser: User | undefined): Promise<Media> {
    const entity = await this.storage.get(id);
    if(await this.isDataAuthorized(entity, 'r', executingUser))
      return entity;
    else throw new Error(`User ${executingUser?.login} is not authorized to access media with id ${entity.id}`)
  }

  async update(id: string | number, entityToUpdate: Media, executingUser: User): Promise<Media> {
    throw new Error('Not Implemented');
  }

  async isDataAuthorized(data: Media, right: string = 'r', user?: any): Promise<boolean> {
    // TODO : implements secure access to media
    return true;
  }

}
