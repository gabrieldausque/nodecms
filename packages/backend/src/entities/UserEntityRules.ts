import {EntityRules} from "./EntityRules";
import {Metadata} from "./Metadata";
import {User} from "./User";

export class UserEntityRules extends EntityRules {

  static validatePassword(password: string):boolean {
    let regexp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/g
    return regexp.test(password);
  }

  static validateLogin(login: string):boolean {
    let regexp = /^[a-zA-Z0-9]{5,}$/g
    return regexp.test(login);
  }

  static validateMetadata(user: User, data: Metadata) {
    data.ownerType = 'user';
    data.ownerId = user.id;
    data.isPublic = false;
  }
}
