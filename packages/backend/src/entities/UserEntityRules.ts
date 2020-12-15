import {EntityRules} from "./EntityRules";
import {Metadata} from "./Metadata";
import {User} from "./User";

export class UserEntityRules extends EntityRules {

  static validatePassword(password: string | undefined):boolean {
    let regexp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/g
    return typeof password !== 'undefined' && password.trim() !== '' && password !== null  && regexp.test(password);
  }

  static validateLogin(login: string | undefined):boolean {
    let regexp = /^[a-zA-Z0-9]{5,}$/g
    return typeof login !== 'undefined' && login.trim() !== '' && login !== null && regexp.test(login);
  }

  static validateMetadata(user: User, data: Metadata) {
    data.ownerType = 'user';
    data.ownerId = user.id;
    data.isPublic = false;
  }
}
