import {Metadata, MetadataStorage} from "./MetadataStorage";
import path from "path";
const dataLoader = require('csv-load-sync');
import * as fs from 'fs';
import {isNumber} from '../../../helpers';
const fsPromises = fs.promises;

export class CSVMetadataStorage implements MetadataStorage {
  public static metadata:any[] = [
    {
      contractType:'MetadataStorage',
      contractName:'CSV',
      isShared:true
    },
    {
      contractType:'MetadataStorage',
      contractName:'Default',
      isShared:true
    },
  ]
  private database: Metadata[];
  private readonly filePath: string;

  constructor(filePath:string = 'data/metadata.csv') {
    if(!filePath){
      filePath = 'data/metadata.csv';
    }
    this.database = [];
    this.filePath = filePath;
    this.reloadDatabase();
  }

  get(keyOrId:string | number, ownerType:string |null = '', ownerId:number | null = null):Metadata {
    let metadata;
    if(typeof keyOrId === 'number') {
      metadata = this.database.find(m  => m.id === keyOrId)
    } else if(isNumber(keyOrId)) {
      keyOrId = parseInt(keyOrId.toString())
      metadata = this.database.find(m  => m.id === keyOrId);
    } else {
      metadata = this.database.find(m  =>
        m.key === keyOrId &&
        m.ownerType === ownerType &&
        m.ownerId === ownerId
      );
    }
    if(metadata)
      return metadata;
    throw new Error(`Metadata with key or id ${keyOrId} doesn't exists`)
  }

  reloadDatabase() {
    const fromFile = dataLoader(this.filePath)
    this.database = fromFile.map((m:any) => {
      return {
        id: parseInt(m.id),
        key: m.key,
        value: m.value,
        isPublic: (m.isPublic.toLowerCase() === 'true'),
        ownerType: (m.ownerType)?m.ownerType:'',
        ownerId: (m.ownerId)?parseInt(m.ownerId):null
      }
    });
  }

  async create(data: Metadata): Promise<Metadata> {
    if(!this.exists(data.key, data.ownerType,data.ownerId)) {
      const newMetadata:Metadata = {
        id: this.getNewId(),
        key: data.key,
        value: data.value,
        isPublic: data.isPublic,
        ownerType: (data.ownerType)?data.ownerType:"",
        ownerId: (isNumber(data.ownerId))?data.ownerId:null
      }
      this.database.push(newMetadata);
      await this.saveDatabase();
      return newMetadata;
    }
    return this.get(data.key, data.ownerType, data.ownerId);
  }

  async delete(keyOrId: string | number, ownerType?: string | null, ownerId?: number | null): Promise<Metadata> {
    let metadata = this.get(keyOrId, ownerType, ownerId);
    this.database.splice(this.database.indexOf(metadata),1);
    await this.saveDatabase();
    return metadata
  }

  exists(keyOrId: string | number, ownerType?: string | null, ownerId?: number | null): boolean {
    let metadata;
    if(typeof keyOrId === 'number') {
      metadata = this.database.find(m  => m.id === keyOrId)
    } else if(isNumber(keyOrId)) {
      keyOrId = parseInt(keyOrId.toString())
      metadata = this.database.find(m  => m.id === keyOrId);
    } else {
      metadata = this.database.find(m  =>
        m.key === keyOrId &&
        m.ownerType === ownerType &&
        m.ownerId === ownerId
      );
    }
    return !!metadata;

  }

  find(filter?: Metadata): Metadata[] {
    if(filter) {
      const found = this.database.find((m:Metadata) => {
        if(filter.key) {
          if(filter.ownerType && filter.ownerId) {
            return m.key === filter.key && m.ownerType === filter.ownerType;
          }
          return m.key === filter.key;
        } else if(filter.ownerType) {
          if(filter.ownerId)
            return m.ownerType === filter.ownerType && m.ownerId === filter.ownerId;
          return m.ownerType === filter.ownerType;
        }
           return false;
      });
      if(found) {
        if(Array.isArray(found))
          return found
        else
          return [found];
      }
    }
    return [];
  }

  async update(data: Metadata): Promise<Metadata> {
    this.database.splice(this.database.findIndex((m:Metadata) =>
      m.id === data.id
    ), 1, data);
    await this.saveDatabase();
    return data;
  }

  private getNewId() {
    let lastId = 0;
    for(const m of this.database) {
      if(m.id && m.id > lastId) {
        lastId = m.id;
      }
    }
    return lastId + 1;
  }

  async saveDatabase() {
    let dbAsString = '"id","key","value","isPublic","ownerType","ownerId"\n';
    for(const metadata of this.database) {
      dbAsString += `"${metadata.id}","${metadata.key}",${(metadata.value)?JSON.stringify(metadata.value):''},"${typeof metadata.isPublic === 'boolean'?metadata.isPublic:false}","${metadata.ownerType ? metadata.ownerType:''}","${isNumber(metadata.ownerId)?metadata.ownerId:''}"\n`;
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
}
