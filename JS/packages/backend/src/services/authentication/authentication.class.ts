import {Id, NullableId, Paginated, Params, ServiceMethods} from '@feathersjs/feathers';
import {Application} from '../../declarations';
import {NotAcceptable, NotAuthenticated} from "@feathersjs/errors";
import {BaseService, BaseServiceConfiguration} from "../BaseService";
import {User, User as UserEntity} from "@nodecms/backend-data";
import {AuthenticationUseCases} from "../../usecases/AuthenticationUseCases";
import {NotAuthorizedError} from "@nodecms/backend-data";
import {Authentication as AuthenticationEntity} from '@nodecms/backend-data';
import {AuthenticationEntityRules} from "@nodecms/backend-data-rules";

type AuthenticationDTO = Partial<AuthenticationEntity>;

interface ServiceOptions extends BaseServiceConfiguration {

}

export class Authentication extends BaseService<AuthenticationDTO,
  AuthenticationEntityRules,  AuthenticationUseCases> {

  options: ServiceOptions;

  constructor (options: ServiceOptions = {
    storage:{
      contractName:'Default'
    }
    }, app: Application) {
    super(app, 'authentication','Authentication',options);
    this.options = options;
  }

  async find (params?: Params): Promise<AuthenticationDTO[] | Paginated<AuthenticationDTO>> {
    if(!params || !params.authenticationToken || !params.user)
      throw new NotAuthenticated();
    return await this.get(params.user.login, params);
  }

  // get login from token, return false if user is not authenticated
  async get (id: Id, params?: Params): Promise<any> {
    if(!params || !params.authenticationToken || !params.user)
      throw new NotAuthenticated();
    if(params.user as User && (params.user as User).login) {
      id = (params.user as User).login;
    }
    if(id)
      return await this.useCase.get(id,params.user as User,params.authenticationToken,params.clientId);
    throw new NotAuthenticated();
  }

  // Create identity token
  async create (data: AuthenticationDTO, params?: Params): Promise<any> {
    try {
      return await this.useCase.create(data, params?.user as User)
    } catch(error) {
      throw new NotAuthenticated(error);
    }
  }

  // renew existing token if existing token still ok and period of
  async update (id: NullableId, data: AuthenticationDTO, params?: Params): Promise<AuthenticationDTO> {
    if(!id)
      throw new NotAcceptable()
    return await this.useCase.update(id,data, params?.user as User);
  }

  async patch (id: NullableId, data: AuthenticationDTO, params?: Params): Promise<AuthenticationDTO> {
    throw new NotAuthorizedError('Patch of authentication token not authorized')
  }

  async remove (id: NullableId, params?: Params): Promise<any> {
    // TODO : trace logout activity
    if(params && params.user as User && typeof (params.user as User).id === 'number') {
      const userId = (params.user as User).id;
      if(typeof userId === 'number')
        await this.useCase.delete(userId);
    }
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
    if(context.method === 'create')
    {
      return false;
    }
    return true;
  }

  async isAuthorized(context: any): Promise<boolean> {
    return true;
  }

  async isDataAuthorized(data: any, right:string='r',user?:UserEntity):Promise< boolean> {
    return true;
  }
}
