export interface User {
  login:string;
  password:string;
  isActive:boolean;
}

export interface AuthenticationStorage {
  exists(login:string):boolean;

  readUser(login: string):null|User;
  // TODO : create all methods : create, update, delete, exists
  getAllUsers(): User[];
}
