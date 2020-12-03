import {Id, NullableId, Paginated, Params, ServiceMethods} from '@feathersjs/feathers';
import {Application} from '../../declarations';
import {globalInstancesFactory} from "@hermes/composition";
import AuthenticationPlugin, {CustomAuthenticatedUserToken} from "../../plugins/Authentication/AuthenticationPlugin";
import {NotAcceptable, NotAuthenticated} from "@feathersjs/errors";
import {EncryptionPlugin} from "../../plugins/Encryption/EncryptionPlugin";
import {BaseService, BaseServiceConfiguration} from "../BaseService";
import {User as UserEntity} from "../../entities/User";
import {AuthenticationUseCases} from "../../usecases/AuthenticationUseCases";

interface Data {
  login?:string,
  password?:string
}

interface ServiceOptions extends BaseServiceConfiguration {
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

export class Authentication extends BaseService<Data, AuthenticationUseCases> {

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
    encryption: {contractName:'Default'},
    storage:{
      contractName:'Default'
    }
    }, app: Application) {
    super(app, 'authentication','Authentication',options);
    this.options = options;
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

    } catch(error) {
      // TODO : return the honey pot token, that give access to : you didn't say the magic word !!!!
      // tokenEncrypted = await this.encryptor.encryptCustomToken(this.honeyPot.token);
      // TODO : Make a specific exception for wrong password and nologin authorized in the time
      throw new NotAuthenticated(error);
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
    return 'logged out';
  }

  [key: string]: any;

  getDomain() {
    const realm = this.app.get('authentication').realm;
    let domain = `${realm}`;
    if(realm === 'localhost'){
      domain = '127.0.0.1'
    }
    return domain
  }

  async needAuthentication(): Promise<boolean> {
    return false;
  }

  async isAuthorized(context: any): Promise<boolean> {
    return true;
  }

  async isDataAuthorized(data: any, right:string='r',user?:UserEntity):Promise< boolean> {
    return true;
  }
}
