// Initializes the `Authentication` service on path `/authentication`
import {ServiceAddons, ServiceMethods} from '@feathersjs/feathers';
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
    authentication:
      {
        contractName: app.get('authentication').authentication.contractName,
        configuration: app.get('authentication').authentication.configuration
      },
    encryption:
      {
        contractName: app.get('authentication').encryption.contractName,
        configuration: app.get('authentication').encryption.configuration
      }
  };

  const authenticationService = new Authentication(options, app);
  configureSwagger(authenticationService);
  // Initialize our service with any options it requires
  app.use('/authentication',(req,res,next) => {
    if(req.feathers && req.headers && req.headers['authorization']) {
      req.feathers.authenticationToken = req.headers['authorization'].replace('Bearer ', '');
    }
    next();
  },
    authenticationService, (req, res, next) => {

    if(req.method.toLowerCase() === 'post' || req.method.toLowerCase() === 'update') {
      const encryptedToken = res.data;
      res.setHeader('Authorization', `Bearer ${encryptedToken}`);
      console.log(`after authentication`);
      res.status(200).json('OK');
    } else {
      res.status(200).json(res.data);
    }

  });

  // Get our initialized service so that we can register hooks
  const service = app.service('authentication');

  service.hooks(hooks);
}

function configureSwagger(service:ServiceMethods<{ [key:string] : any | any[] }>) {
  service.docs = {
    operations: {
      patch:false,
      remove:false,
      find:false
    },
    definitions: {
      authentication: {
        type: 'object',
        required: ['login', 'password'],
        properties: {
          login: { type: 'string', description:'The login'},
          password: { type: 'string', description:'The password'}
        }
      }
    }
  }
}
