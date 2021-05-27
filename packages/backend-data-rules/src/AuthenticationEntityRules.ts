import {EntityRules} from "./EntityRules";
import {Authentication} from "@nodecms/backend-data";
import {InvalidAuthenticationError} from "@nodecms/backend-data";

export class AuthenticationEntityRules extends EntityRules {

    public static validate(entity:Authentication):void{
      if(!(entity.login && entity.password) &&
        !entity.encryptedToken &&
        entity.clientUniqueId
      )
        throw new InvalidAuthenticationError();
    }

  static validateForAuthentication(entity: Authentication) {
    AuthenticationEntityRules.validate(entity)

    if(!(entity.login && entity.password))
      throw new InvalidAuthenticationError(`No authentications info`);

    if(!entity.clientUniqueId)
      throw new InvalidAuthenticationError(`No unique client id`);
  }
}
