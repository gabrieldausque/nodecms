import {UserStorage, User} from "../../interfaces/UserStorage";
import * as fs from "fs";
const fsPromises = fs.promises;
import * as path from "path";

const dataLoader = require('csv-load-sync');

export class CSVUserStorage implements UserStorage {
  public static metadata : any[] = [
    {
      contractType:'UserStorage',
      contractName:'CSV',
      isShared:true
    },
    {
      contractType:'UserStorage',
      contractName:'Default',
      isShared:true
    }
  ]

  private database: User[];
  private filePath: string;

  constructor(filePath:string = 'data/users.csv') {
    if(!filePath){
      filePath = 'data/users.csv';
    }
    this.database = [];
    console.log(`Users file ${filePath}`);
    for(const userFromFile of dataLoader(filePath)) {
      this.database.push({
        id: parseInt(userFromFile.id),
        isActive: (userFromFile.isActive.toLowerCase().trim() === 'true'),
        login: userFromFile.login,
        password: userFromFile.password
      })
    }
    this.filePath = filePath;

  }

  exists(loginOrId: string|number): boolean {
    if(typeof loginOrId === 'string'){
      return this.database.findIndex((u) => u.login === loginOrId) > -1
    } else {
      return this.database.findIndex((u) => u.id === loginOrId) > -1
    }
  }

  readUser(loginOrId: string | number): User {
    let user = null;
    if(typeof loginOrId === 'string')
      user = this.database.find((u) => u.login === loginOrId)
    else
      user = this.database.find((u) => u.id === loginOrId);
    if(!user)
      throw new Error(`No user with login or id ${loginOrId} exists`);
    return user;
  }

  getAllUsers(): User[] {
    return [...this.database];
  }

  async createUser(user: User): Promise<User> {
    if(!this.exists(user.login)) {
      const newUser:User = {
        id: this.getNewId(),
        login: user.login,
        password: user.password,
        isActive: user.isActive
      }
      this.database.push(newUser);
      await this.saveDatabase();
      return user;
    } else {
      console.debug('user already exists');
    }
    return this.readUser(user.login);
  }

  async saveDatabase() {
    let dbAsString = '"id","login","password","isActive"\n';
    for(const user of this.database) {
      dbAsString += `"${user.id}","${user.login}","${user.password}","${user.isActive}"\n`
    }
    const backupPath = `${path.dirname(this.filePath)}/${path.basename(this.filePath).split('.')[0]}-bck.csv`
    await fsPromises.copyFile(this.filePath, backupPath)
    try {
      await fsPromises.writeFile(this.filePath, dbAsString, {
        encoding:'utf8'
      })
    }catch(err) {
      console.error(err);
      await fsPromises.copyFile(backupPath, this.filePath);
      throw err
    }
  }

  async deleteUser(loginOrId: string | number): Promise<User> {
    const user = this.readUser(loginOrId);
    if(user) {
      this.database.splice(this.database.indexOf(user), 1);
      await this.saveDatabase();
    }
    return user;
  }

  async updateUser(user: User): Promise<User> {
    const oldUser = this.readUser(user.login);
    if(oldUser) {
      this.database.splice(this.database.indexOf(oldUser), 1, user);
      await this.saveDatabase();
    } else {
      await this.createUser(user)
    }
    return user;
  }

  private getNewId():number {
    let lastId = 0;
    for(const user of this.database) {
      if(user.id && user.id > lastId) {
        lastId = user.id;
      }
    }
    return lastId + 1;
  }

  public reloadDatabase() {
    this.database = [];
    for(const userFromFile of dataLoader(this.filePath)) {
      this.database.push({
        id: parseInt(userFromFile.id),
        isActive: (userFromFile.isActive.toLowerCase().trim() === 'true'),
        login: userFromFile.login,
        password: userFromFile.password
      })
    }
  }
}
