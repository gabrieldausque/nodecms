// Initializes the `UserEvents` service on path `/user-events`
import { ServiceAddons } from '@feathersjs/feathers';
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
  const options = {
    paginate: app.get('paginate')
  };

  // Initialize our service with any options it requires
  app.use('/user-events', new UserEvents(options, app));

  // Get our initialized service so that we can register hooks
  const service = app.service('user-events');

  service.hooks(hooks);
}
