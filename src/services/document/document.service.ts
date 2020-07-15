// Initializes the `document` service on path `/document`
import { ServiceAddons } from '@feathersjs/feathers';
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
  const options = {
    paginate: app.get('paginate')
  };

  // Initialize our service with any options it requires
  app.use('/document', new Document(options, app));

  // Get our initialized service so that we can register hooks
  const service = app.service('document');

  service.hooks(hooks);
}
