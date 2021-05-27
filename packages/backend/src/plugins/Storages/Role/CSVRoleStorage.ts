import {RoleStorage} from "./RoleStorage";
import path from "path";
const dataLoader = require('csv-load-sync');
import * as fs from 'fs';
import {isNumber} from '@nodecms/backend-data';
import {CSVStorage} from "../CSVStorage";
import {Metadata} from "@nodecms/backend-data";
import {Role} from "@nodecms/backend-data";
const fsPromises = fs.promises;

export class CSVRoleStorage extends CSVStorage<Role> implements RoleStorage{
  public static metadata:any[] = [
    {
      contractType:'RoleStorage',
      contractName:'CSV',
      isShared:true
    },
    {
      contractType:'RoleStorage',
      contractName:'Default',
      isShared:true
    },
  ]

  constructor(filePath:string = 'data/roles.csv') {
    super(filePath);
  }

  getHeaders(): string[] {
    return ["id","key","description"];
  }

  loadEntity(entityFromFile: any): Role {
    return {
      id: parseInt(entityFromFile.id),
      key: entityFromFile.key,
      description: entityFromFile.description
    };
  }

  stringifyEntity(entity: Role): string {
    return `"${entity.id}","${entity.key}","${entity.description}"`;
  }

  async create(data: Role): Promise<Role> {
    if(!await this.exists(data.key)){
      const newRole = {
        id:this.getNewId(),
        key:data.key,
        description:data.description
      }
      this.database.push(newRole);
      await this.saveDatabase();
      return newRole;
    }
    return this.get(data.key);
  }

  async delete(keyOrIdOrRole: string | number | Role): Promise<Role> {
    let keyOrId : string | number = '';
    if(isNumber(keyOrIdOrRole)){
      keyOrId = parseInt(keyOrIdOrRole.toString());
    } else if (typeof keyOrIdOrRole === 'string') {
      keyOrId = keyOrIdOrRole.toString()
    } else {
      const role:Role = keyOrIdOrRole as Role;
      if(role && role.id)
        keyOrId = role.id.toString()
    }
    let role = await this.get(keyOrId);
    this.database.splice(this.database.indexOf(role),1);
    await this.saveDatabase();
    return role;
  }

  async exists(keyOrId: string | number | Role): Promise<boolean> {
    let existing:any;
    if(isNumber(keyOrId))
    {
      const usableId = parseInt(keyOrId.toString());
      existing = this.database.find((r) => r.id === usableId);
    } else if (typeof keyOrId === 'string') {
      existing = this.find({
        key: keyOrId.toString()
      })
    } else if((keyOrId as Role) && (keyOrId as Role).key) {
      existing = await this.find(keyOrId as Role)
    }
    return (Array.isArray(existing) && existing.length > 0)
  }

  async find(filter?: Partial<Role>): Promise<Role[]> {
    if(filter) {
      let found;
      if(filter.id) {
        if(filter.id && filter.key)
          found = this.database.find((r) => r.id === filter.id && r.key === filter.key)
        else
          found = this.database.find((r) => r.id == filter.id);
      } else if(filter.key) {
        if(filter.id && filter.key)
          found = this.database.find((r) => r.id === filter.id && r.key === filter.key)
        else
          found = this.database.find((r) => r.key == filter.key);
      }
      if(Array.isArray(found) && found.length > 0)
        return found;
      else if(found)
        return [found];
    }
    return [];
  }

  async get(keyOrId: string | number): Promise<Role> {
    let existing;
    if(isNumber(keyOrId))
    {
      const usableId = parseInt(keyOrId.toString());
      existing = this.database.find((r) => r.id === usableId);
    } else {
      existing = await this.find({
        key: keyOrId.toString()
      })
    }
    if(Array.isArray(existing) && existing.length === 1)
      return existing[0];
    else if(!Array.isArray(existing) && existing)
      return existing;
    throw new Error(`Role with key or id ${keyOrId} doesn't exists`);
  }

  async update(data: Role): Promise<Role> {
    this.database.splice(this.database.findIndex((m:Metadata) =>
      m.id === data.id
    ), 1, data);
    await this.saveDatabase();
    return data;
  }


}
