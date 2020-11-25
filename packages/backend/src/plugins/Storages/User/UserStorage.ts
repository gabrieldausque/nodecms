import {Storage} from "../Storage";
import {User} from "../../../entities/User";

export interface UserStorage extends Storage<User> {
  exists(loginOrId:string|number):Promise<boolean>;

  get(loginOrId: string|number):Promise<User>;

  find(filter?: User): Promise<User[]>;

  create(user: User):Promise<User>;

  update(user: User):Promise<User>;

  delete(loginOrId: string | number):Promise<User>;
}
