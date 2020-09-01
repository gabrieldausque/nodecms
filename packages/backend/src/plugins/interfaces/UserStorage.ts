export interface User {
  id?:number;
  login:string;
  password:string;
  isActive:boolean;
}

export interface UserStorage {
  exists(loginOrId:string|number):boolean;

  readUser(loginOrId: string|number):User;
  // TODO : create all methods : update, delete, exists
  getAllUsers(): User[];

  createUser(user: User):Promise<User>;

  updateUser(user: User):Promise<User>;

  deleteUser(loginOrId: string | number):Promise<User>;
}
