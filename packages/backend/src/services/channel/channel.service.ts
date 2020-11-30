// Initializes the `channel` service on path `/channel`
import { ServiceAddons } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import { Channel } from './channel.class';
import hooks from './channel.hooks';

// Add this service to the service type index
declare module '../../declarations' {
  interface ServiceTypes {
    'channel': Channel & ServiceAddons<any>;
  }
}

export default function (app: Application): void {
  let options = {
    paginate: app.get('paginate'),
    storage:{
      contractName:'Default'
    },
    topicService:{
      contractName: 'Default'
    }
  };

  const globalChannelStorageConfiguration = app.get('storage').channels;
  const globalTopicServiceConfiguration = app.get('topicService');
  options.storage = {...options.storage, ...globalChannelStorageConfiguration};
  options.topicService = {...options.topicService, ...globalTopicServiceConfiguration};

  const channelConfiguration = app.get('channel');
  options = { ...options, ...channelConfiguration};

  // Initialize our service with any options it requires
  app.use('/channel', new Channel(options, app));

  // Get our initialized service so that we can register hooks
  const service = app.service('channel');

  service.hooks(hooks);
}
