// Initializes the `Authentication` service on path `/authentication`
import { ServiceAddons } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import { Authentication } from './authentication.class';
import hooks from './authentication.hooks';

// Add this service to the service type index
declare module '../../declarations' {
  interface ServiceTypes {
    'authentication': Authentication & ServiceAddons<any>;
  }
}

export default function (app: Application) {
  const options = {
    paginate: app.get('paginate'),
    contractName: app.get('authentication').contractName
  };

  // Initialize our service with any options it requires
  app.use('/authentication', new Authentication(options, app));

  // Get our initialized service so that we can register hooks
  const service = app.service('authentication');

  service.hooks(hooks);
}
