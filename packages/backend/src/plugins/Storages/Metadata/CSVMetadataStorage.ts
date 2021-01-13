import {MetadataStorage} from "./MetadataStorage";
import path from "path";
const dataLoader = require('csv-load-sync');
import * as fs from 'fs';
import {isNumber} from '../../../helpers';
import {CSVStorage} from "../CSVStorage";
import {Metadata} from "../../../entities/Metadata";
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

  public reloadDatabase() {
    this.database = [];
    for(const entity of dataLoader(this.filePath, {
      getColumns: (line:string, lineNumber:number) => {
        if (lineNumber === 0) { // title line
          return line.split(',')
        }
        //case for serialized array
        const regexpArray = /("*\[.+\]"*)/g;
        const m = regexpArray.exec(line);
        if(m){
          for(const arrayToReplace of m){
            const target = arrayToReplace.replace(',',':');
            line = line.replace(arrayToReplace,target)
          }
          const splitLine = line.split(',');
          const finalLine = []
          for(const field of splitLine) {
            if(regexpArray.test(field)){
              finalLine.push(field.replace(':',','))
            } else {
              finalLine.push(field)
            }
          }
          return finalLine;
        } else {
          return line.split(',')
        }
      }
    })) {
      this.database.push(this.loadEntity(entity))
    }
  }

  async get(keyOrId:string | number, ownerType:string |null = '', ownerId:number | null = null):Promise<Metadata> {
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

  async exists(keyOrId: string | number, ownerType?: string | null, ownerId?: number | null): Promise<boolean> {
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
    return Array.isArray(metadata) && metadata.length > 0;

  }

  async find(filter?: Metadata): Promise<Metadata[]> {
    if(filter) {
      const found = this.database.find((m:Metadata) => {
        if(filter.key) {
          if(filter.ownerType && filter.ownerId) {
            return m.key === filter.key && m.ownerType === filter.ownerType && m.ownerId === filter.ownerId;
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
    if(!await this.exists(data.key, data.ownerType,data.ownerId)) {
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
    return await this.get(data.key, data.ownerType, data.ownerId);
  }

  async delete(keyOrId: string | number, ownerType?: string | null, ownerId?: number | null): Promise<Metadata> {
    let metadata = await this.get(keyOrId, ownerType, ownerId);
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
    let value = entityFromFile.value;
    try{
      value = JSON.parse(value);
    }catch(err) {
      //Do nothing, it's only when we are trying to parse the value ...
    }
    return {
      id: parseInt(entityFromFile.id),
      key: entityFromFile.key,
      value: value,
      isPublic: (entityFromFile.isPublic.toLowerCase() === 'true'),
      ownerType: (entityFromFile.ownerType)?entityFromFile.ownerType:'',
      ownerId: (entityFromFile.ownerId)?parseInt(entityFromFile.ownerId):null
    };
  }

  stringifyEntity(entity: Metadata): string {
    return `"${entity.id}","${entity.key}",${(entity.value)?JSON.stringify(entity.value):''},"${typeof entity.isPublic === 'boolean'?entity.isPublic:false}","${entity.ownerType ? entity.ownerType:''}","${isNumber(entity.ownerId)?entity.ownerId:''}"`;
  }

  getHeaders(): string[] {
    return ["id","key","value","isPublic","ownerType","ownerId"];
  }

}
