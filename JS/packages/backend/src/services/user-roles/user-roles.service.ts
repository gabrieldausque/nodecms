// Initializes the `UserRoles` service on path `/user/:idOrLogin/roles`
import { ServiceAddons } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import { UserRoles } from './user-roles.class';
import hooks from './user-roles.hooks';

// Add this service to the service type index
declare module '../../declarations' {
  interface ServiceTypes {
    'user/:idOrLogin/roles': UserRoles & ServiceAddons<any>;
  }
}

export default function (app: Application): void {
  const options = {
    paginate: app.get('paginate'),
    storage:{
      contractName:'Default'
    }
  };

  // Initialize our service with any options it requires
  app.use('/user/:idOrLogin/roles', new UserRoles(options, app));

  // Get our initialized service so that we can register hooks
  const service = app.service('user/:idOrLogin/roles');

  service.hooks(hooks);
}
