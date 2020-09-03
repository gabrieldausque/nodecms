// Initializes the `Metadata` service on path `/metadata`
import {ServiceAddons, ServiceMethods} from '@feathersjs/feathers';
import { Application } from '../../declarations';
import { Metadata } from './metadata.class';
import hooks from './metadata.hooks';

// Add this service to the service type index
declare module '../../declarations' {
  interface ServiceTypes {
    'metadata': Metadata & ServiceAddons<any>;
  }
}

export default function (app: Application): void {
  let options = {
    paginate: app.get('paginate'),
    storage:{
      contractName:'Default'
    }
  };
  const globalMetadataStorageConfiguration = app.get('storage').metadata;
  options.storage = {...options.storage, ...globalMetadataStorageConfiguration}

  const configFromFile = app.get('metadata');
  options = {...options, ...configFromFile};

  // Initialize our service with any options it requires
  const metadataService = new Metadata(options, app);
  configureSwagger(metadataService);
  app.use('/metadata', metadataService);

  // Get our initialized service so that we can register hooks
  const service = app.service('metadata');

  service.hooks(hooks);
}

function configureSwagger(service:ServiceMethods<{ [key:string] : any | any[] }>) {
  service.docs = {
    definitions: {
      metadata: {
        type: 'object',
        required: ['key', 'value'],
        properties: {
          id: { type:'number', description:'The id of the metadata'},
          key: { type: 'string', description:'The key that identifies the metadata'},
          value: { type: 'string', description:'The value of the metadata, as JSON'},
          isPublic: { type:'boolean', description:'True if the metadata can be read without authentication, false if not'},
          ownerType: { type: 'string', description:'The type of the object that owns this metadata (can be user, document, etc ...) if it is null or undefined, it belongs to the whole application instance'},
          ownerId: { type: 'number', description:'The id of the owner if it is not the whole application'}
        }
      },
      metadata_list: {
        type: 'array',
        items: {
          $ref: '#components/schemas/metadata'
        }
      }
    }
  }
}
