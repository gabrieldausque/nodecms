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

  protected async getCollection(collectionName?:string):Promise<Collection> {
    const finalCollectionName:string = collectionName?collectionName:this.collectionName;
    return (await this.getMongoDb()).collection<T>(finalCollectionName);
  }

  protected async getNewId(collectionName?:string):Promise<number>{
    const db = await this.getMongoDb();
    const finalCollectionName:string = collectionName?collectionName:this.collectionName;
    const result = await db.collection<counterByCollection>('counters').findOneAndUpdate({
      name:finalCollectionName
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

  protected async internalCreate(entity:T, collectionName?:string) {
    const finalCollectionName:string = collectionName?collectionName:this.collectionName;
    await (await this.getCollection(finalCollectionName)).insertOne(
      entity
    )
  }

  protected async internalUpdate(entity: Partial<T>, collectionName?:string) {
    const finalCollectionName:string = collectionName?collectionName:this.collectionName;
    await (await this.getCollection(finalCollectionName)).findOneAndUpdate({
      id: entity.id
    },{
      $set: entity
    })
  }

  protected async internalDelete(entity:Partial<T>, collectionName?:string) {
    const finalCollectionName:string = collectionName?collectionName:this.collectionName;
    await (await this.getCollection(finalCollectionName)).deleteOne(
      entity
    )
  }

  protected async internalFind(filter?:Partial<T> | null | undefined | any, collectionName?:string):Promise<T[]> {
    const finalCollectionName:string = collectionName?collectionName:this.collectionName;
    let found:T[] = [];
    if(filter){
      found = await (await this.getCollection(finalCollectionName))
        .find(filter)
        .toArray();
    }
    found.map((f:any) => {
      delete f._id
    })
    return found;
  }

  protected async internalGet(searchId:number, collectionName?:string):Promise<T | null> {
    const finalCollectionName:string = collectionName?collectionName:this.collectionName;
    const found = await (await this.getCollection(finalCollectionName)).findOne<T>({
      id:searchId
    })
    if(found && found._id)
      delete (found as any)._id
    return found;
  }

  abstract exists(keyOrId: string | number | T, collectionName?:string): Promise<boolean>;

  abstract get(keyOrId: string | number, collectionName?:string): Promise<T>;

  abstract find(filter?: Partial<T>, collectionName?:string): Promise<T[]>;

  abstract create(data: Partial<T>, collectionName?:string): Promise<T>;

  abstract update(data: Partial<T>, collectionName?:string): Promise<T>;

  abstract delete(keyOrId: string | number | T, collectionName?:string): Promise<T>;

}
