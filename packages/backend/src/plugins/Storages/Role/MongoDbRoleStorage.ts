import {MongoDbStorage, MongoDbStorageConfiguration} from "../MongoDbStorage";
import {Role} from "../../../entities/Role";
import {isNumber} from "../../../helpers";
import {Authorization} from "../../../entities/Authorization";

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

  async create(data: Role): Promise<Role> {
    if(!await this.exists(data.key)){
      const newRole = {
        id:await this.getNewId(),
        key:data.key,
        description:data.description
      }
      await this.internalCreate(newRole)
    }
    return this.get(data.key);
  }

  async delete(keyOrIdOrRole: string | number | Role): Promise<Role> {
    let keyOrId : string | number = '';
    if(!(typeof keyOrIdOrRole === 'number') &&
      !(typeof keyOrIdOrRole === 'string') &&
      keyOrIdOrRole && keyOrIdOrRole.id) {
      keyOrId = keyOrIdOrRole.id.toString()
    } else {
      keyOrId = keyOrIdOrRole.toString();
    }
    let role = await this.get(keyOrId);
    await this.internalDelete(role);
    return role;
  }

  async exists(keyOrIdOrRole: string | number | Role): Promise<boolean> {
    let found:Role[] = [];
    if(isNumber(keyOrIdOrRole)) {
      found = await this.find({
        id:parseInt(keyOrIdOrRole.toString()),
        key:''
      })
    } else if(typeof keyOrIdOrRole === 'string'){
      found = await this.find({
        key:keyOrIdOrRole
      })
    } else if((keyOrIdOrRole as Role)) {
      found = await this.find(keyOrIdOrRole as Role)
    }
    return Array.isArray(found) && found.length > 0;
  }

  async find(filter: Role | undefined): Promise<Role[]> {
    if(filter)
      return await this.internalFind(filter);
    return [];
  }

  async get(keyOrId: string | number): Promise<Role> {
    if(isNumber(keyOrId)) {
      const usableId = (typeof keyOrId === 'string')?parseInt(keyOrId.toString()):keyOrId;
      const found = await this.internalGet(usableId)
      if(found)
        return found;
    } else if (typeof keyOrId === 'string') {
      const found = await this.internalFind({
        key:keyOrId
      })
      if(Array.isArray(found) &&  found.length > 0){
        return found[0];
      }
    }
    throw new Error(`No role with id or key ${keyOrId}`);
  }

  async update(data: Role): Promise<Role> {
    await this.internalUpdate(data);
    return await this.get(data.key)
  }

}
