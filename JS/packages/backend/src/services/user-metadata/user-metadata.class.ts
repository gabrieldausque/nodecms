import { Id, NullableId, Paginated, Params } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {BaseService, BaseServiceConfiguration} from "../BaseService";
import {globalInstancesFactory} from "@hermes/composition";
import {UserUseCases} from "../../usecases/UserUseCases";
import {MethodNotAllowed, NotAcceptable, NotFound} from "@feathersjs/errors";
import {isNumber} from "@nodecms/backend-data";
import {MetadataUseCases} from "../../usecases/MetadataUseCases";
import {Metadata} from "@nodecms/backend-data";
import {User as UserEntity} from "@nodecms/backend-data";
import {MetadataEntityRules} from "@nodecms/backend-data-rules";

type MetadataDTO = Partial<Metadata>

interface ServiceOptions extends BaseServiceConfiguration {}

export class UserMetadata extends BaseService<MetadataDTO,
  MetadataEntityRules,
  MetadataUseCases> {

  app: Application;
  options: ServiceOptions;
  private userUseCases: UserUseCases;
  private metadataUseCases: MetadataUseCases;

  constructor (options: ServiceOptions = {
    storage:{
      contractName:'Default'
    }
  }, app: Application) {
    super(app,'user-metadata', 'Metadata', options);
    this.options = options;
    this.app = app;
    this.userUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','User');
    this.metadataUseCases = this.useCase;
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<MetadataDTO[] | Paginated<MetadataDTO>> {
    throw new MethodNotAllowed();
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<MetadataDTO> {
    if(!params || !params.route || !params.route.idOrLogin)
      throw new NotAcceptable(`No user id`);
    const user:UserEntity = await this.userUseCases.get(params.route.idOrLogin);
    const metadataKeyOrId = id;
    const executingUser:UserEntity = params?.user as UserEntity;
    try {
      return await this.userUseCases.getMetadata(user, metadataKeyOrId, executingUser);
    } catch(err) {
      throw new NotFound(err.message);
    }
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async create (data: MetadataDTO, params?: Params): Promise<MetadataDTO> {
    if(!params || !params.route || !params.route.idOrLogin)
      throw new NotAcceptable(`No user id indicated`);
    const user:UserEntity = await this.userUseCases.get(params.route.idOrLogin);
    const executingUser:UserEntity = params?.user as UserEntity;
    return await this.userUseCases.createMetadata(user, data, executingUser);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: MetadataDTO, params?: Params): Promise<MetadataDTO> {

    if(!params || !params.route || !params.route.idOrLogin)
      throw new NotAcceptable(`No user id indicated`);
    if(!id)
      throw new NotAcceptable(`No metadata id indicated`);
    const executingUser:UserEntity = params?.user as UserEntity;
    const user:UserEntity = await this.userUseCases.get(params.route.idOrLogin, executingUser);
    let metadata:Metadata;
    if(isNumber(id))
      metadata = await this.metadataUseCases.get(id, executingUser);
    else
    {
      const found = await this.metadataUseCases.find({
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
    return await this.userUseCases.updateMetadata(user, {...metadata, ...data}, executingUser);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async patch (id: NullableId, data: MetadataDTO, params?: Params): Promise<MetadataDTO> {
    return await this.update(id, data, params);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async remove (id: NullableId, params?: Params): Promise<MetadataDTO> {
    if(!params || !params.route || !params.route.idOrLogin)
      throw new NotAcceptable(`No user id indicated`);
    if(!id)
      throw new NotAcceptable(`No metadata id indicated`);
    const user:UserEntity = await this.userUseCases.get(params.route.idOrLogin);
    const executingUser:UserEntity = params?.user as UserEntity;
    let metadata:Metadata;
    if(isNumber(id))
      metadata = await this.metadataUseCases.get(id, executingUser);
    else
    {
      const found = await this.metadataUseCases.find({
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
    await this.metadataUseCases.delete(metadata.id, executingUser);
    return metadata;
  }

  async needAuthentication(context: any): Promise<boolean> {
    return true;
  }

  async isDataAuthorized(data: any,right:string='r',user?:UserEntity):Promise< boolean> {
    return this.metadataUseCases.isDataAuthorized(data,right,user);
  }

}
