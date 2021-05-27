import {isNumber} from "./helpers";

export abstract class EntityRules {

  public static convertId(id? : string| number):number {
    if((id && isNumber(id)) || id === 0)
      return parseInt(id.toString());
    throw new Error('id must be a number');
  }

  public static validateId(id? : string| number):boolean {
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


}
