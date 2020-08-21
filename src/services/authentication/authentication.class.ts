import {Id, NullableId, Paginated, Params, ServiceMethods} from '@feathersjs/feathers';
import {Application} from '../../declarations';
import {globalInstancesFactory} from "@hermes/composition";
import AuthenticationPlugin, {CustomAuthenticatedUserToken} from "../../plugins/interfaces/AuthenticationPlugin";
import {NotAcceptable} from "@feathersjs/errors";
import {EncryptionPlugin} from "../../plugins/interfaces/EncryptionPlugin";

interface Data {
  login?:string,
  password?:string
}

interface ServiceOptions {
  authentication: {
    contractName:string
    configuration?:any
  },
  encryption: {
    contractName:string,
    configuration?:any
  }
}

interface HoneyPot {
  token: CustomAuthenticatedUserToken;
}

export class Authentication implements ServiceMethods<Data> {
  app: Application;
  options: ServiceOptions;
  authenticator: AuthenticationPlugin
  encryptor: EncryptionPlugin;
  honeyPot: HoneyPot = {
    token: {
      authenticationDate: new Date(),
      authorityKey: "honeyPot",
      login: "winnie",
    }
  };

  constructor (options: ServiceOptions = {
    authentication: {contractName:'Default'},
    encryption: {contractName:'Default'}
    }, app: Application) {
    this.options = options;
    this.app = app;
    this.authenticator = globalInstancesFactory.getInstanceFromCatalogs('AuthenticationPlugin',
      options.authentication.contractName,
      options.authentication.configuration)
    this.encryptor = globalInstancesFactory.getInstanceFromCatalogs('EncryptionPlugin',
      options.encryption.contractName,
      options.encryption.configuration
    )
  }

  async find (params?: Params): Promise<Data[] | Paginated<Data>> {
    return [];
  }

  async get (id: Id, params?: Params): Promise<any> {
    if(!params || !params.authenticationToken)
      return false;
    const decryptedToken:CustomAuthenticatedUserToken = await this.encryptor.decryptCustomToken(params.authenticationToken);
    return this.authenticator.isAuthenticated(id.toString(), decryptedToken);
  }

  async create (data: Data, params?: Params): Promise<any> {
    let tokenEncrypted:string;
    try {
      const login = (data.login)?data.login:'anonymous';
      const password = (data.password)?data.password:'nopass';

      // TODO : check the client : no repeat tentative, etc ...
      if(!this.authenticator.canAuthenticate(login, {
        clientUniqueId: params?.clientUniqueId
      })){
        throw new NotAcceptable(`User ${login} can't authenticate for now, please retry later`);
      }

      if(login === 'anonymous' || password === 'nopass') {
        throw new NotAcceptable('Login or password wrong. Please retry')
      // TODO : log client ip or identifier tentative for login in an unauthorize way for further counter measure
      }

      const tokenDecrypted = await this.authenticator.authenticate(login, password);
      tokenEncrypted = await this.encryptor.encryptCustomToken(tokenDecrypted);

    } catch(ex) {
      // TODO : return the honey pot token, that give access to : you didn't say the magic word !!!!
      tokenEncrypted = await this.encryptor.encryptCustomToken(this.honeyPot.token);
      // TODO : Make a specific exception for wrong password and nologin authorized in the time
    }

    return tokenEncrypted;
  }

  async update (id: NullableId, data: Data, params?: Params): Promise<Data> {
    return data;
  }

  async patch (id: NullableId, data: Data, params?: Params): Promise<Data> {
    return data;
  }

  async remove (id: NullableId, params?: Params): Promise<any> {
    return { id };
  }
}
