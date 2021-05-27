// Initializes the `media` service on path `/media`
import { ServiceAddons, ServiceMethods } from '@feathersjs/feathers';
import { Application } from '../../declarations';
import { Media } from './media.class';
import hooks from './media.hooks';
import multer from 'multer';
import fs from 'fs';

// Add this service to the service type index
declare module '../../declarations' {
  interface ServiceTypes {
    'media': Media & ServiceAddons<any>;
  }
}

export default function (app: Application) {
  let options = {
    paginate: app.get('paginate'),
    storage:{
      contractName:'Default',
      fsStore:"uploads",
    }
  };

  const globalMediaStorageConfiguration = app.get('storage').media;
  options.storage = {...options.storage, ...globalMediaStorageConfiguration};

  const mediaConfiguration = app.get('media');
  options = { ...options, ...mediaConfiguration};

  const multipartMiddleWare = multer({
    dest: 'uploads/temp/'
  });
  const mediaService = new Media(options, app);
  configureSwagger(mediaService);
  // Initialize our service with any options it requires
  app.use('/media',
    multipartMiddleWare.single('blob'),
    async (req:any, res:any, next:any) => {
      if(req.file){
        const p = new Promise(((resolve, reject) => {
          fs.readFile(req.file.path, (err, buffer) => {
            if(err)
              reject(err);
            else {
              req.body.blob = buffer;
              resolve(undefined);
            }
          })
        }));
        try {
          await p;
        }catch(error){
          console.error(error)
        } finally {
          fs.unlink(req.file.path, (err => {
            if(err)
              console.error(err);
          }))
        }
      }
      next();
    },
    mediaService
  );

  // Get our initialized service so that we can register hooks
  const service = app.service('media');
  service.hooks(hooks);
}

function configureSwagger(service:ServiceMethods<{ [key:string] : any | any[] }>) {
  service.docs = {
    operations: {
      patch: false,
      update:false
    },
    definitions: {
      media: {
        type: 'object',
        required: ['key', 'blob'],
        properties: {
          id: { type:'number', description:'The id of the media'},
          key: { type: 'string', description:'The key of the media'},
          label: { type: 'string', description:'The label of the media'},
          ownerId: { type:'number', description:'the id of the owner'},
          blob: { type:'string', format:'binary', description:'the file to upload as a media'}
        }
      },
      media_list: {
        type: 'array',
        items: {
          $ref: '#components/schemas/media'
        }
      }
    }
  }
}
