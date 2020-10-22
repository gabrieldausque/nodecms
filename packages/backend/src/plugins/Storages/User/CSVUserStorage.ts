import {CSVStorage} from "../CSVStorage";
import {UserStorage} from './UserStorage';
import * as fs from "fs";
const fsPromises = fs.promises;
import * as path from "path";
import {User} from "../../../entities/User";

export class CSVUserStorage extends CSVStorage<User> implements UserStorage {
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

  constructor(filePath:string = 'data/users.csv') {
    super(filePath)
  }

  loadEntity(userFromFile: any): User {
    return {
      id: parseInt(userFromFile.id),
      isActive: (userFromFile.isActive.toLowerCase().trim() === 'true'),
      login: userFromFile.login,
      password: userFromFile.password
    }
  }

  exists(loginOrId: string|number): boolean {
    if(typeof loginOrId === 'string'){
      return this.database.findIndex((u) => u.login === loginOrId) > -1
    } else {
      return this.database.findIndex((u) => u.id === loginOrId) > -1
    }
  }

  get(loginOrId: string | number): User {
    let user = null;
    if(typeof loginOrId === 'string')
      user = this.database.find((u) => u.login === loginOrId)
    else
      user = this.database.find((u) => u.id === loginOrId);
    if(!user)
      throw new Error(`No user with login or id ${loginOrId} exists`);
    return user;
  }

  find(filter: User): User[] {
    if(filter) {
      const filtered = [];
      for(const user of this.database) {
        if(user.id === filter.id) {
          filtered.push(user);
        }
      }
      return filtered
    }
    return [...this.database];
  }

  async create(user: User): Promise<User> {
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
    return this.get(user.login);
  }

  async delete(loginOrId: string | number): Promise<User> {
    const user = this.get(loginOrId);
    if(user) {
      this.database.splice(this.database.indexOf(user), 1);
      await this.saveDatabase();
    }
    return user;
  }

  async update(user: User): Promise<User> {
    const oldUser = this.get(user.login);
    if(oldUser) {
      this.database.splice(this.database.indexOf(oldUser), 1, user);
      await this.saveDatabase();
    } else {
      await this.create(user)
    }
    return user;
  }

  stringifyEntity(entity: User): string {
    return `"${entity.id}","${entity.login}","${entity.password}","${entity.isActive}"`;
  }

  getHeaders(): string[] {
    return ["id","login","password","isActive"];
  }

}