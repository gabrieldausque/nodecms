import {Entity} from '../../entities/Entity';
import {Storage} from './Storage'
import {MongoClient} from 'mongodb';
import {globalInstancesFactory} from "@hermes/composition";
import {Logger} from "../Logging/Logger";

export interface MongoDbStorageConfiguration {
  mongodbUser:string,
  mongodbPassword:string,
  mongodbUrl:string
  DbName:string
  CollectionName:string
}

export abstract class MongoDbStorage<T extends Entity> implements Storage<T> {

  private readonly logger?:Logger;
  private readonly mongodbConnexionString:string
  private readonly mongoClient: MongoClient;
  private readonly dbName: string;
  private readonly collectionName: string;

  protected constructor(configuration:MongoDbStorageConfiguration, logger?:Logger) {
    this.mongodbConnexionString = `mongodb+srv://${configuration.mongodbUser}:${configuration.mongodbPassword}@${configuration.mongodbUrl}?retryWrites=true&w=majority`;
    this.mongoClient = new MongoClient(this.mongodbConnexionString)
    this.dbName = configuration.DbName;
    this.collectionName = configuration.CollectionName;
    this.logger = logger;
    this.init().then(() => {
      logger?.debug(`Connection to ${this.dbName} done ? ${this.mongoClient.isConnected()}`)
    }).catch((err) => {
      logger?.error(`Error while connecting to ${this.dbName} : ${err?.toString()}`)
    })
  }

  protected async init() {
    if(!this.mongoClient.isConnected()){
      await this.mongoClient
    }
  }

  abstract create(data: T): Promise<T>;

  abstract delete(keyOrId: string | number): Promise<T>;

  abstract exists(keyOrId: string | number): Promise<boolean>;

  abstract find(filter?: T): Promise<T[]>;

  abstract get(keyOrId: string | number): Promise<T>;

  abstract update(data: T): Promise<T>;

}
