import {EntityRules} from "./EntityRules";
import {Authentication} from "./Authentication";
import {InvalidAuthenticationError} from "./Errors/InvalidAuthenticationError";

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
