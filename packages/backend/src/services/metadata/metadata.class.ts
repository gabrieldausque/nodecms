import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {BaseService} from "../BaseService";
import {MetadataUseCases} from "../../usecases/MetadataUseCases";
import {NotAcceptable, NotFound} from "@feathersjs/errors";
import {ServiceOptions} from "../helpers";
import {isNumber} from "../../helpers";
import {globalInstancesFactory} from "@hermes/composition";


interface MetadataDTO {
  id?: number;
  key: string;
  value?: any;
  isPublic?: boolean;
  ownerType?:string | null;
  ownerId?:number | null;
}

export class Metadata extends BaseService<MetadataDTO> {

  options: ServiceOptions;
  useCase: MetadataUseCases;

  constructor (options: ServiceOptions = {
    storage:{
      contractName:'Default'
    }
  }, app: Application) {
    super(app, 'metadata');
    this.options = options;
    this.useCase = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Metadata',options);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<MetadataDTO[] | Paginated<MetadataDTO>> {
    if(params && params.query)
      return this.useCase.find({
        key: params.query.key,
        ownerType: params.query.ownerType,
        ownerId: params.query.ownerId
      });
    return []
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<MetadataDTO> {
    if(id) {
      if(isNumber(id)) {
        try {
          return this.useCase.get(id.toString());
        } catch(err) {
          throw new NotFound(err.message);
        }
      } else {
        const filter = { key: id.toString()}
        const found = this.useCase.find(filter)
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
        const found = this.useCase.find(filter)
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
    return this.useCase.create(data);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: MetadataDTO, params?: Params): Promise<MetadataDTO> {
    if(id) {
      const existing = await this.get(id, params);
      if(existing && isNumber(existing.id) && typeof existing.id !== 'undefined') {
        return this.useCase.update(existing.id, data)
      }
    } else if(params && params.query) {
      const found = await this.find(params);
      if(Array.isArray(found) && found.length > 0) {
        const existing = found[0];
        if (existing && isNumber(existing.id) && typeof existing.id !== 'undefined') {
          return this.useCase.update(existing.id, data)
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
    if(id){
      const existing = await this.get(id, params);
      if(existing && existing.id) {
        return this.useCase.delete(existing.id)
      }
    }
    throw new NotFound(`No metadata with key : ${id}`);
  }

  async isAuthorized(context: any): Promise<boolean> {
    //check authorization for method
    throw new Error("Method not implemented.");
  }

  async isDataAuthorized(data:MetadataDTO):Promise<boolean>{
    throw new Error("Method not implemented.");
  }

  needAuthentication(context:any): boolean {
    if(context.method.toLowerCase() === 'get' || context.method.toLowerCase() === 'find') {
      if(context.id){
        if(isNumber(context.id)) {
          const data = this.useCase.get(context.id)
          if(data)
            return !data.isPublic;
        } else {
          const filtered = this.useCase.find({ key: context.id.toString()})
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
          const filtered = this.useCase.find(context.params.query);
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
