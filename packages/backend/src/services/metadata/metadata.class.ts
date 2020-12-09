import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {BaseService, BaseServiceConfiguration} from "../BaseService";
import {MetadataUseCases} from "../../usecases/MetadataUseCases";
import {NotAcceptable, NotFound} from "@feathersjs/errors";
import {isNumber} from "../../helpers";
import {globalInstancesFactory} from "@hermes/composition";
import {User as UserEntity} from "../../entities/User";


export interface MetadataDTO {
  id?: number;
  key: string;
  value?: any;
  isPublic?: boolean;
  ownerType?:string | null;
  ownerId?:number | null;
}

interface ServiceOptions extends BaseServiceConfiguration {

}

export class Metadata extends BaseService<MetadataDTO, MetadataUseCases> {

  options: ServiceOptions;

  constructor (options: ServiceOptions = {
    storage:{
      contractName:'Default'
    }
  }, app: Application) {
    super(app, 'metadata', 'Metadata',options);
    this.options = options;
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<MetadataDTO[] | Paginated<MetadataDTO>> {
    if(params && params.query) {
      const executingUser:UserEntity = params?.user as UserEntity;
      return await this.useCase.find({
        key: params.query.key,
        ownerType: params.query.ownerType,
        ownerId: params.query.ownerId
      }, executingUser)
    };
    return []
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<MetadataDTO> {
    const executingUser:UserEntity = params?.user as UserEntity;
    if(id || id === 0) {
      if(isNumber(id)) {
        try {

          return await this.useCase.get(id.toString(), executingUser);
        } catch(err) {
          throw new NotFound(err.message);
        }
      } else {
        const filter = { key: id.toString()}
        const found = await this.useCase.find(filter, executingUser)
        if(found) {
          if(found.length === 1)
            return found[0];
          else
            throw new NotFound(`Current filter ${filter} has returned more than one element. Use find method instead or correct filter`);
        }
      }
    } else {
      if (params && params.query && params.query.key) {
        const filter = {
          key: params.query.key,
          ownerType: params.query.ownerType?params.query.ownerType:'',
          ownerId: params.query.ownerId?params.query.ownerId:null
        }
        const found = await this.useCase.find(filter, executingUser)
        if(found) {
          if(found.length === 1)
            return found[0];
          else
            throw new NotFound(`Current filter ${filter} has returned more than one element. Use find method instead or correct filter`);
        }
      }
    }
    throw new NotFound(`no metadata with key : ${id}`);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async create (data: MetadataDTO, params?: Params): Promise<MetadataDTO> {
    const executingUser:UserEntity = params?.user as UserEntity;
    return this.useCase.create(data, executingUser);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: MetadataDTO, params?: Params): Promise<MetadataDTO> {
    const executingUser:UserEntity = params?.user as UserEntity;
    if(id || id === 0) {
      const existing = await this.get(id, params);
      if(existing && isNumber(existing.id) && typeof existing.id !== 'undefined') {
        return this.useCase.update(existing.id, data, executingUser)
      }
    } else if(params && params.query) {
      const found = await this.find(params);
      if(Array.isArray(found) && found.length > 0) {
        const existing = found[0];
        if (existing && isNumber(existing.id) && typeof existing.id !== 'undefined') {
          return this.useCase.update(existing.id, data, executingUser)
        }
      }
    }
    throw new NotFound(`id ${id} or query ${params?.query} are incorrect for update.`)
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async patch (id: NullableId, data: MetadataDTO, params?: Params): Promise<MetadataDTO> {
    return this.update(id,data, params);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async remove (id: NullableId, params?: Params): Promise<MetadataDTO> {
    const executingUser:UserEntity = params?.user as UserEntity;
    if(typeof id === 'number'){
      const existing = await this.get(id, params);
      if(existing && typeof existing.id === 'number') {
        return await this.useCase.delete(existing.id, executingUser)
      }
    }
    throw new NotFound(`No metadata with key : ${id}`);
  }

  async isDataAuthorized(data:MetadataDTO | MetadataDTO[],right:string='r',user?:UserEntity):Promise<boolean>{
    if(Array.isArray(data)) {
      for(const oneData of data){
        if(!(await this.isDataAuthorized(oneData, right,user)))
          return false;
      }
      return true;
    } else {
      const searchData = await this.useCase.find(data, user);
      if(Array.isArray(searchData) && searchData.length > 0) {
        const oneData = searchData[0];
        if(oneData.isPublic)
          return oneData.isPublic;
        else
        {
          //TODO : find roles of user, and search for the right authorization for reading this data
          return this.useCase.isDataAuthorized(oneData, right, user);
        }
      }
      return false;
    }
  }

  async needAuthentication(context:any): Promise<boolean> {
    await this.validAuthentication(context?.params, true);
    const executingUser:UserEntity = context?.user as UserEntity;
    if(context.method.toLowerCase() === 'get' || context.method.toLowerCase() === 'find') {
      if(context.id){
        if(isNumber(context.id)) {
          const data = await this.useCase.get(context.id, executingUser)
          if(data)
            return !data.isPublic;
        } else {
          const filtered = await this.useCase.find({ key: context.id.toString()})
          if(filtered && filtered.length > 0) {
            for(const m of filtered){
              if(!m.isPublic)
                return true
            }
            return false;
          }
        }
      } else {
        if(context.params.query) {
          const filtered = await this.useCase.find(context.params.query);
          if(filtered && filtered.length > 0) {
            for(const m of filtered){
              if(!m.isPublic)
                return true
            }
            return false;
          }
        }
      }
    }
    return true;
  }
}
