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

  const authenticationConfiguration =  app.get('authentication');
  if(!authenticationConfiguration.authentication ||
    !authenticationConfiguration.authentication.contractName ||
    !authenticationConfiguration.realm
  ) {
    throw new Error('Authentication configuration is incomplete, please correct');
  }

  const options = {
    paginate: app.get('paginate'),
    authentication:
      {
        contractName: app.get('authentication').authentication.contractName,
        configuration: app.get('authentication').authentication.configuration
      },
    encryption:
      {
        contractName: app.get('encryption').contractName,
        configuration: app.get('encryption').configuration
      }
  };

  if(!options.authentication.configuration){
    options.authentication.configuration = {}
  }

  if(!options.authentication.configuration.storage) {
    options.authentication.configuration.storage = app.get('storage').users
  }

  const authenticationService = new Authentication(options, app);
  configureSwagger(authenticationService);
  // Initialize our service with any options it requires
  app.use('/authentication',
    authenticationService, (req, res, next) => {
    if(req.method.toLowerCase() === 'post' || req.method.toLowerCase() === 'update') {
      const encryptedToken = res.data;
      const realm = app.get('authentication').realm;
      const domain = authenticationService.getDomain();
      const cookie = [
        `ncms-uniqueid=${authenticationService.encryptor.encryptClientId(req.body['login'])} ; Domain=${domain}; HttpOnly; SameSite:Lax`,
        `ncms-token=${encryptedToken} ; Domain=${domain}; HttpOnly; SameSite:Lax`,
        `realm=${realm} ; Domain=${domain}; HttpOnly; SameSite:Lax`
      ];
      res.setHeader('Set-Cookie', cookie);
      res.status(200).json('OK');
    } else if (req.method.toLowerCase() === 'delete'){
      const domain = authenticationService.getDomain();
      res.clearCookie('ncms-uniqueid', {domain:domain});
      res.clearCookie('ncms-token', {domain:domain});
      res.clearCookie('realm', {domain:domain});
      res.status(205).json('Logged Out');
    }
    else {
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
