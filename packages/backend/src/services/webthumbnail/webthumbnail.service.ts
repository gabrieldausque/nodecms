// Initializes the `webthumbnail` service on path `/webthumbnail`
import { ServiceAddons } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import { WebThumbnail } from './webthumbnail.class';
import hooks from './webthumbnail.hooks';

// Add this service to the service type index
declare module '../../declarations' {
  interface ServiceTypes {
    'webthumbnail': WebThumbnail & ServiceAddons<any>;
  }
}

export default function (app: Application): void {
  const options = {
    paginate: app.get('paginate')
  };

  // Initialize our service with any options it requires
  app.use('/webthumbnail', new WebThumbnail(options, app));

  // Get our initialized service so that we can register hooks
  const service = app.service('webthumbnail');

  service.hooks(hooks);
}
