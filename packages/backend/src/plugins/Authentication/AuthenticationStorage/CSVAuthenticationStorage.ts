import {AuthenticationStorage, User} from "../../interfaces/AuthenticationStorage";

const dataLoader = require('csv-load-sync');

export class CSVAuthenticationStorage implements AuthenticationStorage {
  public static metadata : any[] = [
    {
      contractType:'AuthenticationStorage',
      contractName:'CSV',
      isShared:true
    },
    {
      contractType:'AuthenticationStorage',
      contractName:'Default',
      isShared:true
    }
  ]

  private database: User[];

  constructor(filePath:string = 'data/users.csv') {
    if(!filePath){
      filePath = 'data/users.csv';
    }
    this.database = dataLoader(filePath);
  }

  exists(login: string): boolean {
    for(const users of this.database){
      if(users.login === login)
        return true;
    }
    return false;
  }

  readUser(login: string): null|User {
    for(const users of this.database){
      if(users.login === login)
        return users;
    }
    return null;
  }

  getAllUsers(): User[] {
    return [...this.database];
  }



}
