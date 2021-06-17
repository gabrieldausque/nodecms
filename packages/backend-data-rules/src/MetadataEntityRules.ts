import {isNumber} from "@nodecms/backend-data";
import {EntityRules} from "./EntityRules";
import {Metadata} from "@nodecms/backend-data";

export class MetadataEntityRules extends EntityRules<Metadata> {

  validateKey(key:string):boolean {
    const regexp = /[a-zA-Z0-9_\-]{3,}/g
    if(!regexp.test(key)) {
      throw new Error('Key must be 3 characters length minimum, using letters, numbers, "-" or "_"');
    }
    return true;
  }

  convertFilter(filter: Metadata):Metadata {
    const regexpIsNumber = /^[0-9]+$/g
    if(filter.id && regexpIsNumber.test(filter.id.toString())) {
      filter.id = parseInt(filter.id.toString());
    }

    if(filter.ownerId && regexpIsNumber.test(filter.ownerId.toString())) {
      filter.ownerId = parseInt(filter.ownerId.toString());
    }
    return filter;
  }

  convert(metadata: Metadata) {
    this.validateKey(metadata.key);
    if(metadata.ownerType) {
      metadata.ownerType = metadata.ownerType.toLowerCase();
      if(!isNumber(metadata.ownerId))
        throw new Error ('If ownerType is set you must have a numeric id');
    }

    if(metadata.ownerId) {
      metadata.ownerId = this.convertId(metadata.ownerId);
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
