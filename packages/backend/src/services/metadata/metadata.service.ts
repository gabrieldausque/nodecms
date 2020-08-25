// Initializes the `Metadata` service on path `/metadata`
import { ServiceAddons } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import { Metadata } from './metadata.class';
import hooks from './metadata.hooks';

// Add this service to the service type index
declare module '../../declarations' {
  interface ServiceTypes {
    'metadata': Metadata & ServiceAddons<any>;
  }
}

export default function (app: Application): void {
  const defaultOptions = {
    paginate: app.get('paginate'),
    useCase:{
      storage:{
        contractName:'Default',
        configuration: null
      }
    }
  };
  const configFromFile = app.get('metadata');

  const options = {...defaultOptions, ...configFromFile};

  // Initialize our service with any options it requires
  app.use('/metadata', new Metadata(options, app));

  // Get our initialized service so that we can register hooks
  const service = app.service('metadata');

  service.hooks(hooks);
}
