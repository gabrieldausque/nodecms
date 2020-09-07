// Initializes the `user` service on path `/user`
import {ServiceAddons, ServiceMethods} from '@feathersjs/feathers';
import { Application } from '../../declarations';
import { User } from './user.class';
import hooks from './user.hooks';
import {isNumber} from "../../helpers";
import {UserUseCases} from "../../usecases/UserUseCases";

// Add this service to the service type index
declare module '../../declarations' {
  interface ServiceTypes {
    'user': User & ServiceAddons<any>;
  }
}

export default function (app: Application): void {
  let options = {
    paginate: app.get('paginate'),
    storage:{
      contractName:'Default'
    }
  };

  const globalUsersStorageConfiguration = app.get('storage').users;
  options.storage = {...options.storage, ...globalUsersStorageConfiguration}

  const userConfiguration = app.get('user');
  options = {...options, ...userConfiguration};

  const userService = new User(options, app)
  configureSwagger(userService);
  // Initialize our service with any options it requires
  app.use('/user', userService);

  // Get our initialized service so that we can register hooks
  const service = app.service('user');

  service.hooks(hooks);
}

function configureSwagger(service:ServiceMethods<{ [key:string] : any | any[] }>) {
  service.docs = {
    definitions: {
      user: {
        type: 'object',
        required: ['login', 'password'],
        properties: {
          id: { type:'number', description:'The id of the user'},
          login: { type: 'string', description:'The login'},
          password: { type: 'string', description:'The password'},
          isActive: { type:'boolean', description:'true if the current user is active, false if not'}
        }
      },
      user_list: {
        type: 'array',
        items: {
          $ref: '#components/schemas/user'
        }
      }
    }
  }
}
