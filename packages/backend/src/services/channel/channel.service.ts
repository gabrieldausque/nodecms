// Initializes the `channel` service on path `/channel`
import {ServiceAddons, ServiceMethods} from '@feathersjs/feathers';
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
  const channelService = new Channel(options, app);
  configureSwagger(channelService);

  // Initialize our service with any options it requires
  app.use('/channel', channelService);

  // Get our initialized service so that we can register hooks
  const service = app.service('channel');

  service.hooks(hooks);
}

function configureSwagger(service:ServiceMethods<{ [key:string] : any | any[] }>) {
  service.docs = {
    definitions: {
      channel: {
        type: 'object',
        required: ['key'],
        properties: {
          id: { type:'number', description:'The id of the channel'},
          key: { type: 'string', description:'The name of the channel'},
          visibility: {
            type: 'string',
            description:'The visibility of the channel',
            items: {
              enum: ['public', 'protected', 'private']
            }
          },

          isActive: { type:'boolean', description:'true if the current user is active, false if not'}
        }
      },
      channel_list: {
        type: 'array',
        items: {
          $ref: '#components/schemas/channel'
        }
      }
    }
  }
}

