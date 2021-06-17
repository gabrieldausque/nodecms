// Initializes the `UserEvents` service on path `/user-events`
import { ServiceAddons, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import { UserEvents } from './user-events.class';
import hooks from './user-events.hooks';

// Add this service to the service type index
declare module '../../declarations' {
  interface ServiceTypes {
    'user-events': UserEvents & ServiceAddons<any>;
  }
}

export default function (app: Application): void {
  let options = {
    paginate: app.get('paginate'),
    storage: {
      contractName: 'Default'
    }
  };

  const globalUserEventStorageConfiguration = app.get('storage').userEvents;
  options.storage = {...options.storage, ...globalUserEventStorageConfiguration};

  const userEventConfiguration = app.get('userEvent');
  options = {...options, ...userEventConfiguration};

  // Initialize our service with any options it requires
  const userEventsService = new UserEvents(options, app);
  configureSwagger(userEventsService);

  app.use('/user-events', new UserEvents(options, app));

  // Get our initialized service so that we can register hooks
  const service = app.service('user-events');

  service.hooks(hooks);
}

function configureSwagger(service:ServiceMethods<{ [key:string] : any | any[] }>) {
  service.docs = {
    definitions: {
      userEvent: {
        type: 'object',
        required: ['startDate', 'endDate'],
        properties: {
          id: { type:'number', description:'The id of the document'},
          startDate: { type:'string', description:'The start date of the event'},
          endDate: { type:'string', description:'The end date of the event'},
          category: { type:'string', description:'The category of the event'},
          ownerId: { type:'number', description:'The user event\'s creator\'s id'},
          ownerAvailabilityStatus: { type: 'string',
            description:'The availability of the owner during the event',
            items: [ 'busy', 'available']
          },
          visibility: {
            type: 'string',
            description:'The visibility of the event',
            items: {
              enum: ['public', 'protected', 'private']
            }
          },
          label: { type:'string', description:'A short description of the event'},
          description: { type:'string', description:'The description of the event'},
          location: { type:'string', description:'The location of the event'},
          attachments: { type:'array', items: {type:'number'}, description: 'The list of media\'s ids attached to the current event'}
        }
      },
      userEvent_list: {
        type: 'array',
        items: {
          $ref: '#components/schemas/userEvent'
        }
      }
    }
  }
}
