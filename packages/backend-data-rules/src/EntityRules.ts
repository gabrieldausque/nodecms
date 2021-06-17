import {Entity, isNumber} from "@nodecms/backend-data";

export abstract class EntityRules<T extends Entity> {

  public convertId(id? : string| number):number {
    if((id && isNumber(id)) || id === 0)
      return parseInt(id.toString());
    throw new Error('id must be a number');
  }

  public validateId(id? : string| number):boolean {
    if(typeof id === 'number')
      return true;
    if(typeof id === 'string') {
      try {
        let idToParse = parseInt(id);
        if(idToParse)
          return true;
      }catch(err) {
        //DO nothing, just a test to parse id to number
      }
    }
    return false;
  }

  public async validateForRead(entity:T):Promise<void> {
  };

  public async validate(entity:T):Promise<void> {
  };

  public async validateForUpdate(entity:T):Promise<void> {
  };

}
