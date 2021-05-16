import {Entity} from '../../entities/Entity';
import {Storage, StorageConfiguration} from './Storage'
import {Collection, Db, MongoClient, QuerySelector} from 'mongodb';
import {globalInstancesFactory} from "@hermes/composition";
import {Logger} from "../Logging/Logger";
import {User} from "../../entities/User";

export interface MongoDbStorageConfiguration extends StorageConfiguration {
  mongodbUser:string,
  mongodbPassword:string,
  mongodbUrl:string,
  dbName:string,
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
    super(configuration);
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

  protected async internalFind(filter?:Partial<T> | null | undefined | any,
                               lastIndex?:string | number,
                               collectionName?:string, sortDescending?:boolean):Promise<T[]> {
    const finalCollectionName:string = collectionName?collectionName:this.collectionName;
    let found:T[] = [];
    if(filter){
      const query:any = {...filter};

      for(const propName in query){
        if(query.hasOwnProperty(propName) && Array.isArray(query[propName])){
          query[propName] = { $all: query[propName] }
        }
      }

      if(typeof lastIndex === "number" || typeof lastIndex === "string"){
          const firstElement = (typeof lastIndex === 'number')?
            (await this.internalGet(lastIndex, collectionName)):
            (await this.internalFind({key:lastIndex}, undefined, collectionName))[0];
          if(sortDescending)
            query.id = {
              $lt: firstElement?.id
            }
          else
            query.id = {
              $gt: firstElement?.id
            }
      }
      if(typeof this.pageSize === 'number')
      {
        if(sortDescending){
          found = await (await this.getCollection(finalCollectionName))
            .find(query)
            .sort({id:-1})
            .limit(this.pageSize)
            .toArray();
        } else {
          found = await (await this.getCollection(finalCollectionName))
            .find(query)
            .limit(this.pageSize)
            .toArray();
        }
      } else {
        if(sortDescending){
          found = await (await this.getCollection(finalCollectionName))
            .find(query)
            .sort({id:-1})
            .toArray();
        }else{
          found = await (await this.getCollection(finalCollectionName))
            .find(query)
            .toArray();
        }
      }
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

  abstract find(filter?: Partial<T>, lastIndex?:number, collectionName?:string): Promise<T[]>;

  abstract create(data: Partial<T>, collectionName?:string): Promise<T>;

  abstract update(data: Partial<T>, collectionName?:string): Promise<T>;

  abstract delete(keyOrId: string | number | T, collectionName?:string): Promise<T>;

}
