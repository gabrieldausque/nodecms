import {Metadata, MetadataStorage} from "./MetadataStorage";
import path from "path";
const dataLoader = require('csv-load-sync');
import * as fs from 'fs';
import {isNumber} from '../../../helpers';
import {CSVStorage} from "../CSVStorage";
const fsPromises = fs.promises;

export class CSVMetadataStorage extends CSVStorage<Metadata> implements MetadataStorage {
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

  constructor(filePath:string = 'data/metadata.csv') {
    super(filePath);
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

  async update(data: Metadata): Promise<Metadata> {
    this.database.splice(this.database.findIndex((m:Metadata) =>
      m.id === data.id
    ), 1, data);
    await this.saveDatabase();
    return data;
  }

  loadEntity(entityFromFile: any): Metadata {
    return {
      id: parseInt(entityFromFile.id),
      key: entityFromFile.key,
      value: entityFromFile.value,
      isPublic: (entityFromFile.isPublic.toLowerCase() === 'true'),
      ownerType: (entityFromFile.ownerType)?entityFromFile.ownerType:'',
      ownerId: (entityFromFile.ownerId)?parseInt(entityFromFile.ownerId):null
    };
  }

  stringifyEntity(entity: Metadata): string {
    return `"${entity.id}","${entity.key}",${(entity.value)?JSON.stringify(entity.value):''},"${typeof entity.isPublic === 'boolean'?entity.isPublic:false}","${entity.ownerType ? entity.ownerType:''}","${isNumber(entity.ownerId)?entity.ownerId:''}"\n`;
  }

  getHeaders(): string[] {
    return ["id","key","value","isPublic","ownerType","ownerId"];
  }

}
