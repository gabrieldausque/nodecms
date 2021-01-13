import {CSVStorage} from "../CSVStorage";
import {AuthorizationStorage} from "./AuthorizationStorage";
import {isNumber} from "../../../helpers";
import {Metadata} from "../../../entities/Metadata";
import {Authorization} from "../../../entities/Authorization";
const dataLoader = require('csv-load-sync');

export class CSVAuthorizationStorage extends CSVStorage<Authorization> implements AuthorizationStorage {

  public static metadata:any[] = [
    {
      contractType:'AuthorizationStorage',
      contractName:'CSV',
      isShared:true
    },
    {
      contractType:'AuthorizationStorage',
      contractName:'Default',
      isShared:true
    },
  ]

  constructor(filepath:string = 'data/authorizations.csv') {
    super(filepath);
  }

  public reloadDatabase() {
    this.database = [];
    for(const entity of dataLoader(this.filePath, {
      getColumns: (line:string, lineNumber:number) => {
        if (lineNumber === 0) { // title line
          return line.split(',')
        }
        //case for serialized array
        const regexpArray = /("\[.+\]")/g;
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

  getHeaders(): string[] {
    return ["id","on","onType","for","right","role"];
  }

  loadEntity(entityFromFile: any): Authorization {
    return {
      id:parseInt(entityFromFile.id),
      on:entityFromFile.on,
      onType:entityFromFile.onType,
      for:entityFromFile.for?entityFromFile.for:'*',
      right:entityFromFile.right,
      role:parseInt(entityFromFile.role)
    };
  }

  stringifyEntity(entity: Authorization): string {
    return `"${entity.id}","${entity.on}","${entity.onType}","${entity.for}","${entity.right}","${entity.role}"`;
  }

  async create(data: Authorization): Promise<Authorization> {
    let newAuthorization:Authorization;
    if(!await this.exists(data)) {
      newAuthorization = {
        id: this.getNewId(),
        on: data.on,
        onType: data.onType,
        for:data.for?data.for:'*',
        right:data.right,
        role:data.role
      }
      this.database.push(newAuthorization);
      await this.saveDatabase();
      return newAuthorization;
    } else {
      await this.update(data);
    }
    return (await this.find(data))[0];
  }

  async update(data:Authorization) {
    if(!await this.exists(data)) {
      await this.create(data);
    }
    //No update is done, right exists or not
    return (await this.find(data))[0];
  }

  async find(filter?: Authorization): Promise<Authorization[]> {
    if(filter) {
      if(isNumber(filter.id) && (filter.id === 0 || filter.id)) {
        return [await this.get(filter.id)];
      }

      if(filter.on && filter.onType && filter.right) {
        let found:Authorization[];

        if(!filter.role) {
          found = this.database.filter((a) => {
            return a.on === filter.on &&
              a.onType === filter.onType &&
              (a.for === filter.for || a.for === '*') &&
              a.right === filter.right
          });
        } else {
          found = this.database.filter((a) => {
            return a.on === filter.on &&
              a.onType === filter.onType &&
              (a.for === filter.for || a.for === '*') &&
              a.right === filter.right &&
              a.role === filter.role
          })
        }

        if(found) {
          if(Array.isArray(found))
            return found;
          else
            return [found]
        }
      }
    }
    return [];
  }

  async get(keyOrId: string | number): Promise<Authorization> {
    if(isNumber(keyOrId)) {
      const usableId = (typeof keyOrId === 'string')?parseInt(keyOrId.toString()):keyOrId;
      const found = this.database.find((a) => a.id === usableId);
      if(found)
        return found;
    }
    throw new Error(`No authorization with id ${keyOrId}`);
  }

  async exists(keyOrIdOrData: string | number | Authorization): Promise<boolean> {
    let found:Authorization[] | null = null;
    if(isNumber(keyOrIdOrData)) {
      found = await this.find({
        id:parseInt(keyOrIdOrData.toString()),
        on:'',
        onType:'',
        for:'',
        right:'',
        role:0
      })
    } else {
      found = await this.find(keyOrIdOrData as Authorization)
    }
    return Array.isArray(found) && found.length > 0;
  }

}
