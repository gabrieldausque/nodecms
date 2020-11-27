import {Entity} from '../../entities/Entity';
import {Storage} from './Storage'
import {Collection, Db, MongoClient} from 'mongodb';
import {globalInstancesFactory} from "@hermes/composition";
import {Logger} from "../Logging/Logger";
import {User} from "../../entities/User";

export interface MongoDbStorageConfiguration {
  mongodbUser:string,
  mongodbPassword:string,
  mongodbUrl:string
  dbName:string
  collectionName:string
}

type counterByCollection = {
  name:string,
  lastId:number
}

export abstract class MongoDbStorage<T extends Entity> extends Storage<T> {

  protected readonly logger?:Logger;
  protected readonly mongodbConnexionString:string
  public readonly mongoClient: MongoClient;
  protected readonly dbName: string;
  protected readonly collectionName: string;

  protected constructor(configuration:MongoDbStorageConfiguration, logger?:Logger) {
    super()
    this.mongodbConnexionString = `mongodb://${configuration.mongodbUser}:${configuration.mongodbPassword}@${configuration.mongodbUrl}`;
    this.mongoClient = new MongoClient(this.mongodbConnexionString, {
      useUnifiedTopology: true,
    })
    this.dbName = configuration.dbName;
    this.collectionName = configuration.collectionName;
    this.logger = logger;
  }

  protected async init() {
    if(!this.mongoClient.isConnected()){
      await this.mongoClient.connect();
    }
  }

  protected async getMongoDb():Promise<Db> {
    if(!this.mongoClient.isConnected()){
      await this.init()
    }
    return this.mongoClient.db(this.dbName);
  }

  protected async getCollection():Promise<Collection> {
    return (await this.getMongoDb()).collection<T>(this.collectionName);
  }

  protected async getNewId():Promise<number>{
    const db = await this.getMongoDb();
    const result = await db.collection<counterByCollection>('counters').findOneAndUpdate({
      name:this.collectionName
    }, {
      $inc: {lastId:1}
    }, {
      upsert:true
    });
    if(result.value){
      return result.value.lastId
    } else {
      return 0
    }
  }

  protected async internalCreate(entity:T) {
    await (await this.getCollection()).insertOne(
      entity
    )
  }

  protected async internalUpdate(data: User) {
    await (await this.getCollection()).findOneAndUpdate({
      id: data.id
    },{
      $set: data
    })
  }

  protected async internalDelete(entity:T) {
    await (await this.getCollection()).deleteOne(
      entity
    )
  }

  protected async internalFind(filter?:Partial<T> | null | undefined):Promise<T[]> {
    let found:T[] = [];
    if(filter){
      found = await (await this.getCollection())
        .find(filter)
        .toArray();
    }
    found.map((f:any) => {
      delete f._id
    })
    return found;
  }

  protected async internalGet(searchId:number):Promise<T | null> {
    const found = await (await this.getCollection()).findOne<T>({
      id:searchId
    })
    delete (found as any)._id
    return found;
  }

  abstract create(data: T): Promise<T>;

  abstract delete(keyOrId: string | number | T): Promise<T>;

  abstract exists(keyOrId: string | number | T): Promise<boolean>;

  abstract find(filter?: Partial<T>): Promise<T[]>;

  abstract get(keyOrId: string | number): Promise<T>;

  abstract update(data: T): Promise<T>;

}
