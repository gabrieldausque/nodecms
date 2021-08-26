// Initializes the `UserMetadata` service on path `/user/:idOrLogin/metadata`
import { ServiceAddons } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import { UserMetadata } from './user-metadata.class';
import hooks from './user-metadata.hooks';

// Add this service to the service type index
declare module '../../declarations' {
  interface ServiceTypes {
    'user/:idOrLogin/metadata': UserMetadata & ServiceAddons<any>;
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
  app.use('/user/:idOrLogin/metadata', new UserMetadata(options, app));

  // Get our initialized service so that we can register hooks
  const service = app.service('user/:idOrLogin/metadata');

  service.hooks(hooks);
}
