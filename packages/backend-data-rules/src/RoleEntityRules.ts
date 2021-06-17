import {EntityRules} from "./EntityRules";
import {Role} from "@nodecms/backend-data";
import {User} from "@nodecms/backend-data";

export class RoleEntityRules extends EntityRules<Role> {

  static validate(entity:Partial<Role>, executingUser:User) {
    if(!entity.members){
      entity.members = [];
      if(executingUser && typeof executingUser.id === 'number'){
        entity.members.push(executingUser.id)
      }
    }

    if(!entity.ownerRoles)
      entity.ownerRoles = []

    if(!(typeof entity.ownerId === 'number')) {
      if(executingUser && typeof executingUser.id ===  'number')
        entity.ownerId = executingUser.id
      else
        entity.ownerId = 0;
    }

    if(!entity.creationDate){
      entity.creationDate = new Date();
    }

    RoleEntityRules.validateKey(entity.key);
  }

  static validateKey(key:string = ''):boolean {
    const regexp = /[a-zA-Z0-9_\-]{3,}/g
    if(!regexp.test(key)) {
      throw new Error('Key must be 3 characters length minimum, using letters, numbers, "-" or "_"');
    }
    return true;
  }

}
