// Initializes the `ChannelPost` service on path `/channel/:idOrKey/posts`
import { ServiceAddons } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import { ChannelPost } from './channel-post.class';
import hooks from './channel-post.hooks';

// Add this service to the service type index
declare module '../../declarations' {
  interface ServiceTypes {
    'channel/:idOrKey/posts': ChannelPost & ServiceAddons<any>;
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

  const globalChannelStorageConfiguration = app.get('storage').channelPosts;
  const globalTopicServiceConfiguration = app.get('topicService');
  options.storage = {...options.storage, ...globalChannelStorageConfiguration};
  options.topicService = {...options.topicService, ...globalTopicServiceConfiguration};

  const channelConfiguration = app.get('channel');
  options = { ...options, ...channelConfiguration};

  // Initialize our service with any options it requires
  app.use('/channel/:channelNameOrId/posts', new ChannelPost(options, app));

  // Get our initialized service so that we can register hooks
  const service:any = app.service('channel/:channelNameOrId/posts');

  service.hooks(hooks);
}
