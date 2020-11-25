import {MongoDbStorage, MongoDbStorageConfiguration} from "../MongoDbStorage";
import {Role} from "../../../entities/Role";

export class MongoDbRoleStorage extends MongoDbStorage<Role> {

  public static metadata:any[] = [
    {
      contractType:'RoleStorage',
      contractName:'MongoDb',
      isShared:true
    }
  ]

  constructor(configuration:MongoDbStorageConfiguration) {
    super(configuration);
  }

  create(data: Role): Promise<Role> {
    throw new Error('Not implemented')
  }

  delete(keyOrId: string | number | Role): Promise<Role> {
    throw new Error('Not implemented')
  }

  exists(keyOrId: string | number | Role): Promise<boolean> {
    throw new Error('Not implemented')
  }

  find(filter: Role | undefined): Promise<Role[]> {
    throw new Error('Not implemented')
  }

  get(keyOrId: string | number): Promise<Role> {
    throw new Error('Not implemented')
  }

  update(data: Role): Promise<Role> {
    throw new Error('Not implemented')
  }

}
