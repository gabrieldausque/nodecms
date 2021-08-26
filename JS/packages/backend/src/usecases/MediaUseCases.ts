import {UseCases} from "./UseCases";
import {Media, MediaVisibility} from "@nodecms/backend-data";
import {User} from "@nodecms/backend-data";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {MediaRules} from "@nodecms/backend-data-rules";
import {MediaStorage} from "../plugins/Storages/Media/MediaStorage";
import {globalInstancesFactory} from "@hermes/composition";
import {UserUseCases} from "./UserUseCases";
import {AlreadyExistsError} from "@nodecms/backend-data";
import {NotFoundError} from "@nodecms/backend-data";
import {NotAuthorizedError} from "@nodecms/backend-data";
import {RoleUseCases} from "./RoleUseCases";

export interface MediaUseCasesConfiguration extends UseCaseConfiguration {
  storage: {
    contractName:string,
    fsStore:string
  }
}

export class MediaUseCases extends UseCases<Media, MediaRules> {

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
    super('media',
      'MediaStorage',
      configuration,
      false,
      MediaRules);
    this.mediaStorage = this.storage as MediaStorage;
  }

  async create(entity: Partial<Media>, executingUser: User): Promise<Media> {
    if(!await this.exists(entity.key)){
      await MediaRules.validate(entity, executingUser);
      return await this.storage.create(entity);
    }
    throw new AlreadyExistsError(`The media with key ${entity.key} already exists`);
  }

  async delete(id: string | number, executingUser: User): Promise<Media> {
    const media = await this.get(id);
    if(media && await this.isDataAuthorized(media, 'w', executingUser)){
      return await this.storage.delete(id);
    }
    throw new NotFoundError(`Media with id ${id} not found`);
  }

  async find(filter: Partial<Media>, lastIndex?:number, executingUser?: User | undefined): Promise<Media[]> {
    const found = await this.storage.find(filter, lastIndex);
    const iter = [...found];
    for(const m of iter){
      if(!(await this.isDataAuthorized(m,'r', executingUser))){
        found.splice(found.indexOf(m), 1);
      }
    }
    return found;
  }

  async get(id: string | number, executingUser?: User | undefined): Promise<Media> {
    const entity = await this.storage.get(id);
    if(await this.isDataAuthorized(entity, 'r', executingUser))
      return entity;
    else throw new NotAuthorizedError(`User ${executingUser?.login} is not authorized to access media with id ${entity.id}`)
  }

  async update(id: string | number, entityToUpdate: Partial<Media>, executingUser: User): Promise<Media> {
    const existing = await this.get(id, executingUser);
    if(existing){
      const updated = {...existing, ...entityToUpdate}
      delete updated.blob;
      await this.storage.update(updated);
    }
    return existing;
  }

  async isDataAuthorized(data: Media, right: string = 'r', user?: any): Promise<boolean> {
    const userUseCases:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'User');
    if(right === 'r') {
      if (data.visibility === MediaVisibility.public)
        return true;
      else if (data.visibility === MediaVisibility.protected)
        return await userUseCases.isValidUser(user, user)
      else if (data.visibility === MediaVisibility.private){
        return await userUseCases.isValidUser(user,user) &&
          await this.isReader(data, user);
      }
    }
    return user.id.toString() === data.ownerId.toString() ||
      await super.isDataAuthorized(data, right, user) ||
      await userUseCases.isUserAdministrators(user,user);
  }

  public async exists(key: string | undefined) {
    return (await this.find({key: key})).length > 0
  }

  public async isReader(media:Media, user:User):Promise<boolean>{
    const userUseCases:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'User');
    const roleUseCases:RoleUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'Role');
    for(const roleId of media.readers){
      const role = await roleUseCases.get(roleId, user);
      if(await userUseCases.isMemberOf(role.key, user, user)){
        return true;
      }
    }
    return false;
  }

}
