import {EntityRules} from "./EntityRules";
import {Authorization} from "../plugins/Storages/Authorization/AuthorizationStorage";

export class AuthorizationEntityRules extends EntityRules {
  static convert(entity:Authorization):Authorization {
    if(entity.id) {
      if(typeof entity.id === 'string')
        entity.id = parseInt(entity.id);
    }

    const mandatoryProperties = ['on','onType','right']
    for(const mandatoryProperty of mandatoryProperties) {
      if(!entity[mandatoryProperty]) {
        throw new Error(`Please set ${mandatoryProperty} on authorization`);
      }
    }

    if(entity.on === 'operation') {
      const authorizedOperations = ['create','get','find','update','patch','remove']
      if(authorizedOperations.indexOf(entity.onType) < 0)
        throw new Error(`Authorized operations are ${authorizedOperations.join('|')}. please correct`);

      if(entity.right !== 'x')
        throw new Error(`Only x ( for execute) is allowed for operation`)

    } else if (entity.on === 'data') {
      if(entity.right !== 'r' && entity.right !== 'w')
        throw new Error(`Only r ( for read) and w (for write) is allowed for data`);
    } else
      throw new Error('on property can only have operation or data as value. please correct');

    if(!entity.for)
      entity.for = '*';

    if(entity.role)
      entity.role = parseInt(entity.role.toString());

    return entity
  }
}
