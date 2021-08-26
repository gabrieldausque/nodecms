// Initializes the `document` service on path `/document`
import {ServiceAddons, ServiceMethods} from '@feathersjs/feathers';
import { Application } from '../../declarations';
import { Document } from './document.class';
import hooks from './document.hooks';

// Add this service to the service type index
declare module '../../declarations' {
  interface ServiceTypes {
    'document': Document & ServiceAddons<any>;
  }
}

export default function (app: Application) {
  let options = {
    paginate: app.get('paginate'),
    storage:{
      contractName:'Default'
    },
    topicService:{
      contractName: 'Default'
    }
  };

  const globalDocumentStorageConfiguration = app.get('storage').documents;
  const globalTopicServiceConfiguration = app.get('topicService');

  options.storage = {...options.storage, ...globalDocumentStorageConfiguration};
  options.topicService = {...options.topicService, ...globalTopicServiceConfiguration}

  const documentConfiguration = app.get('document');
  options = { ...options, ...documentConfiguration};
  const documentService = new Document(options, app);
  configureSwagger(documentService)

  // Initialize our service with any options it requires
  app.use('/document', documentService);

  // Get our initialized service so that we can register hooks
  const service = app.service('document');

  service.hooks(hooks);
}

function configureSwagger(service:ServiceMethods<{ [key:string] : any | any[] }>) {
  service.docs = {
    definitions: {
      document: {
        type: 'object',
        required: ['key', 'content'],
        properties: {
          id: { type:'number', description:'The id of the document'},
          key: { type: 'string', description:'The key of the document'},
          visibility: {
            type: 'string',
            description:'The visibility of the document',
            items: {
              enum: ['public', 'protected', 'private']
            }
          },
          ownerId: { type:'number', description:'The document\'s creator\'s id'},
          documentType: {type:'string', description:'The type of document, will condition the visual control to display this document type'},
          editorRoles: {
            type:'array',
            items: {type:'string'},
            description: 'The ids of roles which members can edit the document'
          },
          editors: {
            type:'array',
            items: {type:'string'},
            description: 'The ids of users that can edit the document'
          },
          readerRoles: {
            type:'array',
            items: {type:'string'},
            description: 'The ids of roles which members can read the document if it is not public'
          },
          readers: {
            type:'array',
            items: {type:'string'},
            description: 'The ids of users that can read the document'
          }
        }
      },
      document_list: {
        type: 'array',
        items: {
          $ref: '#components/schemas/document'
        }
      }
    }
  }
}
