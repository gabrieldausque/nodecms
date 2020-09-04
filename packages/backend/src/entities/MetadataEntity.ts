import {Metadata} from "../plugins/Storages/Metadata/MetadataStorage";
import {isNumber} from "../helpers";

export class MetadataEntity {
  static validateKey(key:string):boolean {
    const regexp = /[a-zA-Z0-9_\-]{3,}/g
    if(!regexp.test(key)) {
      throw new Error('Key must be 3 characters length minimum, using letters, numbers, "-" or "_"');
    }
    return true;
  }

  static convertFilter(filter: Metadata):Metadata {
    const regexpIsNumber = /^[0-9]+$/g
    if(filter.id && regexpIsNumber.test(filter.id.toString())) {
      filter.id = parseInt(filter.id.toString());
    }

    if(filter.ownerId && regexpIsNumber.test(filter.ownerId.toString())) {
      filter.ownerId = parseInt(filter.ownerId.toString());
    }
    return filter;
  }

  static convertId(id: string | number):number {
    if(typeof id === 'number')
      return id;
    if(isNumber(id)) {
      return parseInt(id.toString());
    }
    throw new Error('id must be a number');
  }

  static convert(metadata: Metadata) {
    MetadataEntity.validateKey(metadata.key);
    if(metadata.ownerType) {
      metadata.ownerType = metadata.ownerType.toLowerCase();
      if(!isNumber(metadata.ownerId))
        throw new Error ('If ownerType is set you must have a numeric id');
    }

    if(metadata.ownerId) {
      metadata.ownerId = MetadataEntity.convertId(metadata.ownerId);
      if(!metadata.ownerType)
        throw new Error('If ownerId is set, you must have a ownerType (string, lowercase)')
    }

    if(metadata.isPublic && typeof metadata.isPublic !== 'boolean') {
      metadata.isPublic = metadata.isPublic === 'true';
    } else {
      metadata.isPublic = false;
    }
  }
}
