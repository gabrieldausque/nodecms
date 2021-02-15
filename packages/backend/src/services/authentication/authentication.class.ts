import {Id, NullableId, Paginated, Params, ServiceMethods} from '@feathersjs/feathers';
import {Application} from '../../declarations';
import {globalInstancesFactory} from "@hermes/composition";
import AuthenticationPlugin, {CustomAuthenticatedUserToken} from "../../plugins/Authentication/AuthenticationPlugin";
import {NotAcceptable, NotAuthenticated} from "@feathersjs/errors";
import {EncryptionPlugin} from "../../plugins/Encryption/EncryptionPlugin";
import {BaseService, BaseServiceConfiguration} from "../BaseService";
import {User, User as UserEntity} from "../../entities/User";
import {AuthenticationUseCases} from "../../usecases/AuthenticationUseCases";
import {UserUseCases} from "../../usecases/UserUseCases";
import {isNumber} from "../../helpers";
import {NotAuthorizedError} from "../../entities/Errors/NotAuthorizedError";
import {Authentication as AuthenticationEntity} from '../../entities/Authentication';
import {AuthorizationUseCases} from "../../usecases/AuthorizationUseCases";

type Data = Partial<AuthenticationEntity>;

interface ServiceOptions extends BaseServiceConfiguration {

}

export class Authentication extends BaseService<Data, AuthenticationUseCases> {

  options: ServiceOptions;

  constructor (options: ServiceOptions = {
    storage:{
      contractName:'Default'
    }
    }, app: Application) {
    super(app, 'authentication','Authentication',options);
    this.options = options;
  }

  async find (params?: Params): Promise<Data[] | Paginated<Data>> {
    return [];
  }

  // get login from token, return false if user is not authenticated
  async get (id: Id, params?: Params): Promise<any> {
    if(!params || !params.authenticationToken || !params.user)
      return new NotAuthenticated();
    return await this.useCase.get(id,params.user as User,params.authenticationToken,params.uniqueClientId);
  }

  // Create identity token
  async create (data: Data, params?: Params): Promise<any> {
    try {
      return await this.useCase.create(data, params?.user as User)
    } catch(error) {
      throw new NotAuthenticated(error);
    }
  }

  // renew existing token if existing token still ok and period of
  async update (id: NullableId, data: Data, params?: Params): Promise<Data> {
    if(!id)
      throw new NotAcceptable()
    return await this.useCase.update(id,data, params?.user as User);
  }

  async patch (id: NullableId, data: Data, params?: Params): Promise<Data> {
    throw new NotAuthorizedError('Patch of authentication token not authorized')
  }

  async remove (id: NullableId, params?: Params): Promise<any> {
    // TODO : trace logout activity
    return 'logged out';
  }

  getDomain() {
    const realm = this.app.get('authentication').realm;
    let domain = `${realm}`;
    if(realm === 'localhost'){
      domain = '127.0.0.1'
    }
    return domain
  }

  async needAuthentication(context:any): Promise<boolean> {
    if(context.method === 'remove')
    {
      return true;
    }
    else
    {
      return false;
    }

  }

  async isAuthorized(context: any): Promise<boolean> {
    return true;
  }

  async isDataAuthorized(data: any, right:string='r',user?:UserEntity):Promise< boolean> {
    return true;
  }
}
