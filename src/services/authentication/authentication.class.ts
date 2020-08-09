import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {globalInstancesFactory} from "@hermes/composition";
import AuthenticationPlugin from "../../plugins/interfaces/AuthenticationPlugin";
import {NotAcceptable} from "@feathersjs/errors";

interface Data {
  login?:string,
  password?:string
}

interface ServiceOptions {
  contractName:string,
  configuration?:any
}

export class Authentication implements ServiceMethods<Data> {
  app: Application;
  options: ServiceOptions;
  authenticator: AuthenticationPlugin

  constructor (options: ServiceOptions = { contractName:'Default'}, app: Application) {
    this.options = options;
    this.app = app;
    this.authenticator = globalInstancesFactory.getInstanceFromCatalogs('AuthenticationPlugin', options.contractName, options.configuration)
  }

  async find (params?: Params): Promise<Data[] | Paginated<Data>> {
    return [];
  }

  async get (id: Id, params?: Params): Promise<any> {
    // TODO : extract login, from header token
    // TODO : extract date from header token
    const login:string = '';
    const date:Date = new Date();
    return this.authenticator.isAuthenticated(login, date);
  }

  async create (data: Data, params?: Params): Promise<any> {
    // TODO : add a control for client
    // TODO : add a control for last login tentative for user ...
    let tokenEncrypted:string;
    try {
      const login = (data.login)?data.login:'anonymous';
      const password = (data.password)?data.password:'nopass';

      if(login === 'anonymous' || password === 'nopass') {
        throw new NotAcceptable('Login or password wrong. Please retry')
      // TODO : log client tentative for login in an unauthorize way for further counter measure
      }
      const tokenDecrypted = await this.authenticator.authenticate(login, password);
      tokenEncrypted = await this.encryptor.encrypt(tokenDecrypted);
    } catch(ex) {
      // TODO : return the honey pot token, that give access to : you didn't say the magic word !!!!
      tokenEncrypted = await this.encryptor.encrypt(this.honeyPot.token);
      // TODO : Make a specific exception for wrong password and nologin authorized in the time
    }
    //TODO : set the header token
    return 'Ok';
  }

  async update (id: NullableId, data: Data, params?: Params): Promise<Data> {
    return data;
  }

  async patch (id: NullableId, data: Data, params?: Params): Promise<Data> {
    return data;
  }

  async remove (id: NullableId, params?: Params): Promise<Data> {
    return { id };
  }
}
