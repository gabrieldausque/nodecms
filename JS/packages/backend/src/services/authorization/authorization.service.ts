// Initializes the `Authorization` service on path `/authorization`
import {ServiceAddons, ServiceMethods} from '@feathersjs/feathers';
import { Application } from '../../declarations';
import { Authorization } from './authorization.class';
import hooks from './authorization.hooks';

// Add this service to the service type index
declare module '../../declarations' {
  interface ServiceTypes {
    'authorization': Authorization & ServiceAddons<any>;
  }
}

export default function (app: Application): void {
  let options = {
    paginate: app.get('paginate'),
    storage:{
      contractName:'Default'
    }
  };

  const globalUsersStorageConfiguration = app.get('storage').authorization;
  options.storage = {...options.storage, ...globalUsersStorageConfiguration}

  const authorizationConfiguration = app.get('authorization');
  options = {...options, ...authorizationConfiguration};

  const authorizationService = new Authorization(options, app);
  configureSwagger(authorizationService);

  // Initialize our service with any options it requires
  app.use('/authorization', authorizationService);

  // Get our initialized service so that we can register hooks
  const service = app.service('authorization');

  service.hooks(hooks);
}

function configureSwagger(service:ServiceMethods<{ [key:string] : any | any[] }>) {
  service.docs = {
    definitions: {
      authorization: {
        type: 'object',
        required: ['on', 'onType','for','right','role'],
        properties: {
          id: { type:'number', description:'The id of the authorization'},
          on: { type: 'string', description:'can be operation or data'},
          onType: { type: 'string', description:'For operation, can be create|get|find|update|patch|delete, representing the operation to be executed. can be anything for data, representing the type of the data concerned.'},
          for: { type:'string', description:'For operation, the service concerned, otherwise * for all service. For data, the id of the data concerned'},
          right: {type:'string', description:'Represent the right authorized. For operation only x available. For data, only r or w available'},
          role: {type:'number', description:'The role on which the authorization is done'}
        }
      },
      authorization_list: {
        type: 'array',
        items: {
          $ref: '#components/schemas/authorization'
        }
      }
    }
  }
}
