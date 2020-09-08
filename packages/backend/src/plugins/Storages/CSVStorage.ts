import path from 'path';
import * as fs from 'fs';
import {Storage, Entity} from './Storage'
import {Metadata} from "./Metadata/MetadataStorage";

const fsPromises = fs.promises;

const dataLoader = require('csv-load-sync');

export abstract class CSVStorage<T extends Entity> implements Storage<T> {

  protected filePath:string
  protected database: T[]

  protected constructor(filePath:string) {
    this.filePath = filePath;
    this.database = [];
    this.reloadDatabase();
  }

  abstract create(data: T): Promise<T>;

  async delete(keyOrId: string | number): Promise<T> {
    let entity = this.get(keyOrId);
    this.database.splice(this.database.indexOf(entity),1);
    await this.saveDatabase();
    return entity
  }

  abstract exists(keyOrId: string | number): boolean

  abstract find(filter?: T): T[]

  abstract get(keyOrId: string | number): T

  async update(data: T): Promise<T> {
    this.database.splice(this.database.findIndex((m:Entity) =>
      m.id === data.id
    ), 1, data);
    await this.saveDatabase();
    return data;
  }

  public abstract loadEntity(entityFromFile:any):T

  public abstract stringifyEntity(entity:T):string;

  public abstract getHeaders():string[];

  public async saveDatabase() {
    let dbAsString = ''
    for(const header of this.getHeaders()) {
      dbAsString += `"${header}",`;
    }
    dbAsString = dbAsString.substr(0,dbAsString.length - 1) +'\n';
    for(const entity of this.database) {
      dbAsString += this.stringifyEntity(entity) + '\n';
    }
    const backupPath = `${path.dirname(this.filePath)}/${path.basename(this.filePath).split('.')[0]}-bck.csv`
    await fsPromises.copyFile(this.filePath, backupPath)
    try {
      await fsPromises.writeFile(this.filePath, dbAsString, {
        encoding:'utf8'
      })
    }catch(err) {
      console.error(err);
      await fsPromises.copyFile(backupPath, this.filePath);
      throw err
    }
  }

  public reloadDatabase() {
    this.database = [];
    for(const entity of dataLoader(this.filePath)) {
      this.database.push(this.loadEntity(entity))
    }
  }

  protected getNewId():number {
    let lastId = 0;
    for(const user of this.database) {
      if(user.id && user.id > lastId) {
        lastId = user.id;
      }
    }
    return lastId + 1;
  }



}
