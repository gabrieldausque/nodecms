import {Storage} from "../Storage";

export interface User {
  id?:number;
  login:string;
  password:string;
  isActive:boolean;
}

export interface UserStorage extends Storage<User> {
  exists(loginOrId:string|number):boolean;

  get(loginOrId: string|number):User;

  find(filter?: User): User[];

  create(user: User):Promise<User>;

  update(user: User):Promise<User>;

  delete(loginOrId: string | number):Promise<User>;
}
