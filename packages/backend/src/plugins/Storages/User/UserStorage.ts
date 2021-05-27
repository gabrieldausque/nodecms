import {Storage} from "../Storage";
import {User} from "@nodecms/backend-data/User";

export interface UserStorage extends Storage<User> {
  exists(loginOrId:string|number|Partial<User>):Promise<boolean>;

  get(loginOrId: string|number):Promise<User>;

  find(filter?: Partial<User>): Promise<User[]>;

  create(user: User):Promise<User>;

  update(user: User):Promise<User>;

  delete(loginOrId: string | number | User):Promise<User>;
}
