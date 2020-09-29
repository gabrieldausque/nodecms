import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {BaseService} from "../BaseService";
import {globalInstancesFactory} from "@hermes/composition";
import {UserUseCases} from "../../usecases/UserUseCases";
import {Metadata} from "../../plugins/Storages/Metadata/MetadataStorage";
import {User} from "../../plugins/Storages/User/UserStorage";
import {MethodNotAllowed, NotAcceptable, NotFound, NotImplemented} from "@feathersjs/errors";
import {isNumber} from "../../helpers";
import {MetadataUseCases} from "../../usecases/MetadataUseCases";

type Data = Metadata

interface ServiceOptions {}

export class UserMetadata extends BaseService<Data> {

  app: Application;
  options: ServiceOptions;
  private userUseCases: UserUseCases;
  private metadataUseCases: MetadataUseCases;

  constructor (options: ServiceOptions = {}, app: Application) {
    super(app);
    this.options = options;
    this.app = app;
    this.userUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','User');
    this.metadataUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Metadata');
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<Data[] | Paginated<Data>> {
    throw new MethodNotAllowed();
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<Data> {
    if(!params || !params.route || !params.route.idOrLogin)
      throw new NotAcceptable(`No user id`);
    const user:User = this.userUseCases.get(params.route.idOrLogin);
    const metadataKeyOrId = id;
    try {
      return await this.userUseCases.getMetadata(user, metadataKeyOrId);
    } catch(err) {
      throw new NotFound(err.message);
    }
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async create (data: Data, params?: Params): Promise<Data> {
    if(!params || !params.route || !params.route.idOrLogin)
      throw new NotAcceptable(`No user id indicated`);
    const user:User = this.userUseCases.get(params.route.idOrLogin);
    return await this.userUseCases.createMetadata(user, data);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: Data, params?: Params): Promise<Data> {

    if(!params || !params.route || !params.route.idOrLogin)
      throw new NotAcceptable(`No user id indicated`);
    if(!id)
      throw new NotAcceptable(`No metadata id indicated`);
    const user:User = this.userUseCases.get(params.route.idOrLogin);

    let metadata:Metadata;
    if(isNumber(id))
      metadata = this.metadataUseCases.get(id);
    else
    {
      const found = this.metadataUseCases.find({
        key:id.toString(),
        ownerType:'user',
        ownerId:user.id
      });
      if(!found || found.length <= 0)
        throw new NotFound(`No metadata with key ${id} for user ${user.id}`)
      if(found.length > 1)
        throw new NotAcceptable(`More than one metadata with key ${id} for user ${user.id}. Please contact administrators`)
      metadata = found[0];
    }
    return await this.userUseCases.updateMetadata(user, {...metadata, ...data});
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async patch (id: NullableId, data: Data, params?: Params): Promise<Data> {
    return await this.update(id, data, params);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async remove (id: NullableId, params?: Params): Promise<Data> {
    if(!params || !params.route || !params.route.idOrLogin)
      throw new NotAcceptable(`No user id indicated`);
    if(!id)
      throw new NotAcceptable(`No metadata id indicated`);
    const user:User = this.userUseCases.get(params.route.idOrLogin);
    let metadata:Metadata;
    if(isNumber(id))
      metadata = this.metadataUseCases.get(id);
    else
    {
      const found = this.metadataUseCases.find({
        key:id.toString(),
        ownerType:'user',
        ownerId:user.id
      });
      if(!found || found.length <= 0)
        throw new NotFound(`No metadata with key ${id} for user ${user.id}`)
      if(found.length > 1)
        throw new NotAcceptable(`More than one metadata with key ${id} for user ${user.id}. Please contact administrators`)
      metadata = found[0];
    }
    if(!metadata || !metadata.id)
      throw new NotFound(`No metadata with id or key ${id}`);
    await this.metadataUseCases.delete(metadata.id);
    return metadata;
  }

  needAuthentication(context: any): boolean {
    return true;
  }

  isAuthorized(context: any): boolean {
    throw new Error("Method not implemented.");
  }
  isDataAuthorized(data: any): boolean {
    throw new Error("Method not implemented.");
  }


}
