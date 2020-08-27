import { Id, NullableId, Paginated, Params, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import {BaseService} from "../BaseService";
import {globalInstancesFactory} from "@hermes/composition";
import {MetadataUseCases} from "../../usecases/metadata/MetadataUseCases";
import {NotFound} from "@feathersjs/errors";
import {ServiceOptions} from "../helpers";

interface Data { }

export class Metadata extends BaseService implements ServiceMethods<Data> {
  options: ServiceOptions;
  useCase: MetadataUseCases;

  constructor (options: ServiceOptions = {
    useCase: {
      storage:{
        contractName:'Default',
        configuration: null
      }
    }
  }, app: Application) {
    super(app);
    this.options = options;
    this.useCase = new MetadataUseCases(options.useCase);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async find (params?: Params): Promise<Data[] | Paginated<Data>> {
    return [];
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async get (id: Id, params?: Params): Promise<Data> {
    const metadata = this.useCase.get(id.toString());
    if(metadata)
      return this.useCase.get(id.toString());
    throw new NotFound(`no metadata with key : ${id}`);
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async create (data: Data, params?: Params): Promise<Data> {

    /* if (Array.isArray(data)) {
      return Promise.all(data.map(current => this.create(current, params)));
    }*/

    return data;
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async update (id: NullableId, data: Data, params?: Params): Promise<Data> {
    return data;
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async patch (id: NullableId, data: Data, params?: Params): Promise<Data> {
    return data;
  }

  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  async remove (id: NullableId, params?: Params): Promise<Data> {
    if(id){
      const metadata = this.useCase.get(id.toString())
      if(metadata) {
        // TODO delete the metadata
      }
    }
    throw new NotFound(`No metadata with key : ${id}`);
  }

  needAuthentication(context:any): boolean {
    if(context.method.toLowerCase() === 'get') {
      if(context.id){
        const data = this.useCase.get(context.id)
        if(data)
          return !data.isPublic;
      }
    }
    return true;
  }
}
