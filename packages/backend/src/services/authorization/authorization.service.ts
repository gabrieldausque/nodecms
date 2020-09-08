// Initializes the `Authorization` service on path `/authorization`
import { ServiceAddons } from '@feathersjs/feathers';
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
  const options = {
    paginate: app.get('paginate')
  };

  // Initialize our service with any options it requires
  app.use('/authorization', new Authorization(options, app));

  // Get our initialized service so that we can register hooks
  const service = app.service('authorization');

  service.hooks(hooks);
}
