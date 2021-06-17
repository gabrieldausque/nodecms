import {MongoDbStorage} from "../MongoDbStorage";
import {isNumber, NotFoundError, UserEvent} from "@nodecms/backend-data";
import {UserEventStorage} from "./UserEventStorage";

export class MongoDbUserEventStorage
  extends MongoDbStorage<UserEvent>
  implements UserEventStorage {

  public static metadata:any[] = [
    {
      contractType:'UserEventStorage',
      contractName:'MongoDb',
      isShared:true
    }
  ]

  async create(data: Partial<UserEvent>): Promise<UserEvent> {
    const newId = await this.getNewId();
    const newUserEvent = {
      ...data,
      ...{
        id: newId
      }
    }
    await this.internalCreate(newUserEvent);
    return await this.get(newId);
  }

  async delete(keyOrId: string | number | UserEvent): Promise<UserEvent> {
    if(await this.exists(keyOrId)){
      let usableId:number | null = null;
      if(typeof keyOrId === 'string' || typeof keyOrId === 'number'){
        usableId = parseInt(keyOrId.toString())
      } else if(typeof keyOrId.id === 'number') {
        usableId = keyOrId.id;
      }

      if(typeof usableId === 'number') {
        const deleted = await this.get(usableId);
        await this.internalDelete(deleted)
        return deleted;
      }
    }
    throw new NotFoundError(`UserEvent with id ${keyOrId} not found`)
  }

  async exists(keyOrId: string | number | UserEvent): Promise<boolean> {
    let userEvents:UserEvent[] = []
    if(isNumber(keyOrId)){
      userEvents = await this.find({
        id: parseInt(keyOrId.toString())
      });
    } else {
      userEvents = await this.find(keyOrId as UserEvent);
    }
    return Array.isArray(userEvents) && userEvents.length > 0;
  }

  async find(filter?: Partial<UserEvent>,
             lastIndex?: number): Promise<UserEvent[]> {
    if(filter){
      // TODO : manage the endDate/startDate filter
      return await this.internalFind(filter,
        lastIndex,
        this.collectionName,
        true);
    }
    return [];
  }

  async get(keyOrId: string | number): Promise<UserEvent> {
    let userEvent: UserEvent | null = null;
    if(isNumber(keyOrId)){
      userEvent = await this.internalGet(parseInt(keyOrId.toString()))
    }
    if(userEvent)
      return userEvent
    throw new NotFoundError(`UserEvent with id ${keyOrId} doesn't exists`)
  }

  async update(data: Partial<UserEvent>): Promise<UserEvent> {
    await this.internalUpdate(data);
    return await this.get(data.id as number);
  }

}
