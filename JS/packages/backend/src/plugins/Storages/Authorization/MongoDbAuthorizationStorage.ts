import {MongoDbStorage, MongoDbStorageConfiguration} from "../MongoDbStorage";
import {Authorization, isNumber} from "@nodecms/backend-data";
import {AuthorizationStorage} from "./AuthorizationStorage";

export class MongoDbAuthorizationStorage extends MongoDbStorage<Authorization> {

  public static metadata:any[] = [
    {
      contractType:'AuthorizationStorage',
      contractName:'MongoDb',
      isShared:true
    }
  ]

  constructor(configuration:MongoDbStorageConfiguration) {
    super(configuration);
  }

  async create(data: Authorization): Promise<Authorization> {
      if(!await this.exists(data)){
        data.id = await this.getNewId();
        await this.internalCreate(data)
      }
      return (await this.find(data))[0];
  }

  async delete(keyOrId: string | number| Authorization): Promise<Authorization> {
    const toDelete = await this.get(this.getIdFromParam(keyOrId));
    await this.internalDelete(toDelete);
    return toDelete;
  }

  async exists(keyOrIdOrData: string | number | Authorization): Promise<boolean> {
    let found:Authorization[] | null;
    if(isNumber(keyOrIdOrData)) {
      found = await this.find({
        id:parseInt(keyOrIdOrData.toString()),
        on:'',
        onType:'',
        for:'',
        right:'',
        role:0
      })
    } else if(typeof keyOrIdOrData === 'string' ){
      found = await (await this.getCollection()).findOne({
        key:keyOrIdOrData
      })
    } else {
      found = await this.find(keyOrIdOrData as Authorization)
    }
    return Array.isArray(found) && found.length > 0;
  }



  async find(filter: Authorization | undefined): Promise<Authorization[]> {
    let found:Authorization[] = [];
    if(filter){
      found.push(...(await this.internalFind(filter)));
      found.push(...(await this.internalFind({...filter,...{ for: '*' }})));
    }
    return found;
  }

  async get(keyOrId: string | number): Promise<Authorization> {
    if(isNumber(keyOrId)) {
      const usableId = (typeof keyOrId === 'string')?parseInt(keyOrId.toString()):keyOrId;
      const found = await this.internalGet(usableId)
      if(found)
        return found;
    }
    throw new Error(`No authorization with id ${keyOrId}`);
  }

  async update(data: Authorization): Promise<Authorization> {
    if(!await this.exists(data)) {
      await this.create(data);
    }
    return (await this.find(data))[0];
  }
}
