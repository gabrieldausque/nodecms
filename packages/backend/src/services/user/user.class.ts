import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {BaseService} from "../BaseService";
import {globalInstancesFactory} from "@hermes/composition";
import {UserStorage} from "../../plugins/interfaces/UserStorage";
import {NotAcceptable} from "@feathersjs/errors";

interface UserData {
  id?:number
  login:string
  password:string
  isActive:boolean
}

type UserDTO = UserData;

interface ServiceOptions {
  paginate?:number
  storage:{
    contractName:string;
    configuration?:any
  }
}

export class User extends BaseService implements ServiceMethods<UserDTO>  {

  options: ServiceOptions;
  private userStorage: UserStorage;

  needAuthentication(context: any): boolean {
    return true;
  }

  constructor (options: ServiceOptions = {
    storage:{
      contractName:'Default'
    }
  }, app: Application) {
    super(app);
    this.options = options;
    this.userStorage = globalInstancesFactory.getInstanceFromCatalogs('UserStorage', this.options.storage.contractName, this.options.storage.configuration)
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<UserDTO[] | Paginated<UserDTO>> {
    return [];
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<UserDTO> {
    return this.userStorage.readUser(id);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async create (data: UserData, params?: Params): Promise<UserDTO> {
    const createdUser = await this.userStorage.createUser(data)
    return createdUser;
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: UserData, params?: Params): Promise<UserDTO> {
    try {
      let idToParse:any = id?.toString();
      if(idToParse)
        idToParse = parseInt(idToParse);
      if(idToParse)
        id = idToParse;
    }catch(err) {
      //DO nothing, just a test to parse id to number
    }
    if(id && data && data.id && parseInt(data.id.toString()) === id) {
      const currentUser = await this.get(id, params);
      if(currentUser && currentUser.login === data.login) {
        const updatedUser = await this.userStorage.updateUser(data)
        return updatedUser;
      }
    }
    throw new NotAcceptable('Please set a user id in the url and in the data corresponding to the right login before trying to update');
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async patch (id: NullableId, data: UserData, params?: Params): Promise<UserDTO> {
    return this.update(id, data, params);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async remove (id: NullableId, params?: Params): Promise<UserDTO> {
    try {
      let idToParse:any = id?.toString();
      if(idToParse)
        idToParse = parseInt(idToParse);
      if(idToParse)
        id = idToParse;
    }catch(err) {
      //Do nothing, it is only to convert string id to number
    }
    if(id) {
      return this.userStorage.deleteUser(id);
    }
    throw new Error(`User with id or login ${id} doesn't exist.`)
  }
}
