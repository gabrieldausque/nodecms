import {Metadata} from "../plugins/Storages/Metadata/MetadataStorage";

export class MetadataEntity {
  static validateKey(key:string) {
    const regexp = /[a-zA-Z0-9_\-]{3,}/g
    if(!regexp.test(key)) {
      throw new Error('Key must be 3 characters length minimum, using letters, numbers, "-" or "_"');
    }
    return true;
  }

  static validateFilter(filter: Metadata) {
    if(typeof filter.id === "string") {
      filter.id = parseInt(filter.id);
    }

    if(typeof filter.ownerId === "string") {
      filter.ownerId = parseInt(filter.ownerId);
    }
  }

  static validateId(id: string | number):number {
    if(typeof id === 'number')
      return id;
    if(typeof id === 'string') {
      try {
        let idToParse = parseInt(id);
        if(idToParse)
          return idToParse;
      }catch(err) {
        //DO nothing, just a test to parse id to number
      }
    }
    throw new Error('id must be a number');
  }
}
