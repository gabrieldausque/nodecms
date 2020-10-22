import {Storage} from "../Storage";
import {User} from "../../../entities/User";

export interface UserStorage extends Storage<User> {
  exists(loginOrId:string|number):boolean;

  get(loginOrId: string|number):User;

  find(filter?: User): User[];

  create(user: User):Promise<User>;

  update(user: User):Promise<User>;

  delete(loginOrId: string | number):Promise<User>;
}
