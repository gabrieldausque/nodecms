import {EntityRules} from "./EntityRules";
import {Role} from "./Role";

export class RoleEntityRules extends EntityRules {

  static validate(entity:Role) {
    if(!entity.members)
      entity.members = [];

    RoleEntityRules.validateKey(entity.key);
  }

  static validateKey(key:string):boolean {
    const regexp = /[a-zA-Z0-9_\-]{3,}/g
    if(!regexp.test(key)) {
      throw new Error('Key must be 3 characters length minimum, using letters, numbers, "-" or "_"');
    }
    return true;
  }

}
