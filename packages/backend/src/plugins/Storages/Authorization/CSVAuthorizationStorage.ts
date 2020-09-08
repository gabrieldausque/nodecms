import {CSVStorage} from "../CSVStorage";
import {Authorization, AuthorizationStorage} from "./AuthorizationStorage";
import {Metadata} from "../Metadata/MetadataStorage";
import {isNumber} from "../../../helpers";
const dataLoader = require('csv-load-sync');

export class CSVAuthorizationStorage extends CSVStorage<Authorization> implements AuthorizationStorage {

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
    return ["id","on","onType","for","right","roles"];
  }

  loadEntity(entityFromFile: any): Authorization {
    return {
      id:parseInt(entityFromFile.id),
      on:entityFromFile.on,
      onType:entityFromFile.onType,
      for:entityFromFile.for,
      rights:(entityFromFile.rights)?entityFromFile.rights.split(':'):[],
      roles:(entityFromFile.roles)?JSON.parse(entityFromFile.roles):[]
    };
  }

  stringifyEntity(entity: Authorization): string {
    return `"${entity.id}","${entity.on}","${entity.onType}","${entity.for}","${Array.isArray(entity.rights)?entity.rights.join(':'):''}","${Array.isArray(entity.roles)?JSON.stringify(entity.roles):JSON.stringify([])}"`;
  }

  async create(data: Authorization): Promise<Authorization> {
    let newAuthorization:Authorization;
    if(!this.exists(data)) {
      newAuthorization = {
        id: this.getNewId(),
        on: data.on,
        onType: data.onType,
        for:data.for,
        rights:(Array.isArray(data.rights))?data.rights:[],
        roles:(Array.isArray(data.roles))?data.roles:[]
      }
      this.database.push(newAuthorization);
      await this.saveDatabase();
      return newAuthorization;
    }
    return this.find(data)[0];
  }

  find(filter?: Authorization): Authorization[] {
    if(filter) {
      if(isNumber(filter.id) && (filter.id === 0 || filter.id)) {
        return [this.get(filter.id)];
      }

      if(filter.on && filter.onType && filter.for) {
        const found = this.database.find((a) => {
          return a.on === filter.on &&
            a.onType === filter.onType &&
            (a.for === filter.for || a.for === '*')
        })
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

  get(keyOrId: string | number): Authorization {
    const found = this.find({
      id:parseInt(keyOrId.toString()),
      on:'',
      onType:''
    })
    if(Array.isArray(found) && found.length > 0)
      return found[0];
    throw new Error(`No authorization with id ${keyOrId}`);
  }

  exists(keyOrId: string | number | Authorization): boolean {
    const found = this.find({
      id:parseInt(keyOrId.toString()),
      on:'',
      onType:''
    })
    return Array.isArray(found) && found.length > 0;
  }

}
