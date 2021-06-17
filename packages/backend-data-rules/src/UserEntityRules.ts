import {EntityRules} from "./EntityRules";
import {Metadata} from "@nodecms/backend-data";
import {User} from "@nodecms/backend-data";

export class UserEntityRules extends EntityRules<User> {

  validatePassword(password: string | undefined):boolean {
    let regexp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/g
    return typeof password !== 'undefined' && password.trim() !== '' && password !== null  && regexp.test(password);
  }

  validateLogin(login: string | undefined):boolean {
    let regexp = /^[a-zA-Z0-9]{5,}$/g
    return typeof login !== 'undefined' && login.trim() !== '' && login !== null && regexp.test(login);
  }

  validateMetadata(user: Partial<User>, data: Partial<Metadata>) {
    data.ownerType = 'user';
    if(!user.id && !(user.id === 0))
      throw new Error('User has no id for metadata creation');
    data.ownerId = user.id;
    data.isPublic = false;
  }
}
