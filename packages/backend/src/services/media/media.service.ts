// Initializes the `media` service on path `/media`
import { ServiceAddons } from '@feathersjs/feathers';
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
    dest: 'media/'
  });
  // Initialize our service with any options it requires
  app.use('/media',
    multipartMiddleWare.single('blob'),
    async (req, res, next) => {
      const p = new Promise(((resolve, reject) => {
        fs.readFile(req.file.path, (err, buffer) => {
          if(err)
            reject(err);
          else {
            req.body.blob = buffer;
            resolve();
          }
        })
      }));
      await p;
      next();
    },
    new Media(options, app)
  );

  // Get our initialized service so that we can register hooks
  const service = app.service('media');

  service.hooks(hooks);
}
