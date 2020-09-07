// Initializes the `Metadata` service on path `/metadata`
import {ServiceAddons, ServiceMethods} from '@feathersjs/feathers';
import { Application } from '../../declarations';
import { Metadata } from './metadata.class';
import hooks from './metadata.hooks';
import {isNumber} from "../../helpers";
import {Entity} from "../../plugins/Storages/Storage";
import {User} from "../../plugins/Storages/User/UserStorage";
import {NotAcceptable} from "@feathersjs/errors";

// Add this service to the service type index
declare module '../../declarations' {
  interface ServiceTypes {
    'metadata': Metadata & ServiceAddons<any>;
  }
}

export default function (app: Application): void {
  let options = {
    paginate: app.get('paginate'),
    storage:{
      contractName:'Default'
    }
  };
  const globalMetadataStorageConfiguration = app.get('storage').metadata;
  options.storage = {...options.storage, ...globalMetadataStorageConfiguration}

  const configFromFile = app.get('metadata');
  options = {...options, ...configFromFile};

  // Initialize our service with any options it requires
  const metadataService = new Metadata(options, app);
  configureSwagger(metadataService);
  app.use('/metadata', metadataService);

  // Initialize relationships :
  app.use('/:entityType/:idOrLogin/metadata', async (req,res,next) => {
    const entity:Entity = await (app.service(req.params.entityType) as any).get(req.params.idOrLogin, req.feathers);

    if(req.method.toLowerCase() !== 'post') {
      if(!isNumber(req.params.__feathersId)) {
        req.query.key = req.params.__feathersId;
        req.query.ownerType = req.params.entityType;
        req.query.ownerId = entity.id?.toString();
      }
    }

    if(req.method.toLowerCase() !== 'get' && req.method.toLowerCase() !== 'delete') {
      req.body.ownerType = req.params.entityType;
      req.body.ownerId = entity.id;
      req.body.isPublic = false;
    }

    next()
  }, app.service('metadata'))
  app.use('/user/:idOrLogin/roles', async (req,res,next) => {
    const user:User = await (app.service('user') as any).get(req.params.idOrLogin, req.feathers);

    if(req.method.toLowerCase() !== 'post') {
        req.query.key = 'roles';
        req.query.ownerType = 'user';
        req.query.ownerId = user.id?.toString();
    }

    if(req.method.toLowerCase() !== 'get' && req.method.toLowerCase() !== 'delete') {
      const currentBody = req.body;
      if(!Array.isArray(currentBody)){
        throw new NotAcceptable('Bad request. Please send an array with ids of role')
      }
      req.body = {
        value:currentBody,
        key:'roles',
        ownerType:'user',
        isPublic: false,
        ownerId: user.id?.toString()
      }
    }
    next()

  }, app.service('metadata'), async (req,res, next) => {
    if(Array.isArray(res.data)){
      if(res.data.length > 1)
        throw new Error(`Multiple roles entries user with id or login ${req.params.idOrLogin}. Please contact administrators.`);
      else if(res.data.length === 1) {
        res.data = res.data[0].value;
      }
    } else {
      res.data = res.data.value;
    }
    next();
  })

  // Get our initialized service so that we can register hooks
  const service = app.service('metadata');

  service.hooks(hooks);
}

function configureSwagger(service:ServiceMethods<{ [key:string] : any | any[] }>) {
  service.docs = {
    definitions: {
      metadata: {
        type: 'object',
        properties: {
          id: { type:'number', description:'The id of the metadata'},
          key: { type: 'string', description:'The key that identifies the metadata'},
          value: { type: 'string', description:'The value of the metadata, as JSON'},
          isPublic: { type:'boolean', description:'True if the metadata can be read without authentication, false if not'},
          ownerType: { type: 'string', description:'The type of the object that owns this metadata (can be user, document, etc ...) if it is null or undefined, it belongs to the whole application instance'},
          ownerId: { type: 'number', description:'The id of the owner if it is not the whole application'}
        }
      },
      metadata_list: {
        type: 'array',
        items: {
          $ref: '#components/schemas/metadata'
        }
      }
    }
  }
}
