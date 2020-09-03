import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {BaseService} from "../BaseService";
import {MetadataUseCases} from "../../usecases/metadata/MetadataUseCases";
import {NotAcceptable, NotFound} from "@feathersjs/errors";
import {ServiceOptions} from "../helpers";
import {MetadataEntity} from "../../entities/MetadataEntity";

interface MetadataDTO {
  id?: number;
  key: string;
  value?: any;
  isPublic?: boolean;
  ownerType?:string | null;
  ownerId?:number | null;
}

export class Metadata extends BaseService implements ServiceMethods<MetadataDTO> {
  options: ServiceOptions;
  useCase: MetadataUseCases;

  constructor (options: ServiceOptions = {
    storage:{
      contractName:'Default'
    }
  }, app: Application) {
    super(app);
    this.options = options;
    this.useCase = new MetadataUseCases(options);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<MetadataDTO[] | Paginated<MetadataDTO>> {
    if(params && params.query)
      return this.useCase.findAll({
        key: params.query.key,
        ownerType: params.query.ownerType,
        ownerId: params.query.ownerId
      });
    return []
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<MetadataDTO> {
    const metadata = this.useCase.get(id.toString());
    if(metadata)
      return this.useCase.get(id.toString());
    throw new NotFound(`no metadata with key : ${id}`);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async create (data: MetadataDTO, params?: Params): Promise<MetadataDTO> {
    return this.useCase.create(data);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: MetadataDTO, params?: Params): Promise<MetadataDTO> {
    if(!id)
      throw new NotAcceptable('Please provide a correct id for update');
    return this.useCase.update(id, data);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async patch (id: NullableId, data: MetadataDTO, params?: Params): Promise<MetadataDTO> {
    return data;
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async remove (id: NullableId, params?: Params): Promise<MetadataDTO> {
    if(id){
      const metadata = this.useCase.get(id.toString())
      if(metadata) {
        // TODO delete the metadata
      }
    }
    throw new NotFound(`No metadata with key : ${id}`);
  }

  needAuthentication(context:any): boolean {
    if(context.method.toLowerCase() === 'get' || context.method.toLowerCase() === 'find') {
      if(context.id){
        const data = this.useCase.get(context.id)
        if(data)
          return !data.isPublic;
      } else {
        const filtered = this.useCase.findAll(context.params.query);
        let needAuthent = true;
        for(const m of filtered){
          needAuthent = !m.isPublic;
          if(needAuthent)
            return true
        }
        return false;
      }
    }
    return true;
  }
}
