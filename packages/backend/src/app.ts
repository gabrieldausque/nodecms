import path from 'path';
import favicon from 'serve-favicon';
import compress from 'compression';
import helmet from 'helmet';
import cors from 'cors';

import feathers from '@feathersjs/feathers';
import configuration from '@feathersjs/configuration';
import express from '@feathersjs/express';
import socketio from '@feathersjs/socketio';


import { Application } from './declarations';
import middleware from './middleware';
import services from './services';
import appHooks from './app.hooks';
import channels from './channels';

import {globalInstancesFactory} from '@hermes/composition';
import {Logger} from "./plugins/Logging/Logger";
import {error} from "winston";
globalInstancesFactory.loadExportedClassesFromDirectory(__dirname + '/plugins');
globalInstancesFactory.loadExportedClassesFromDirectory(__dirname + '/usecases');
// Don't remove this comment. It's needed to format import lines nicely.

const app: Application = express(feathers());

// Load app configuration
app.configure(configuration());
// Enable security, CORS, compression, favicon and body parsing
//TODO : add a configuration to manager logger type
const logger:Logger = globalInstancesFactory.getInstanceFromCatalogs('Logger','Default');
logger.info('Application starting');

app.use(helmet());
logger.debug('Initializing cors');
app.use(cors({
  credentials: true,
  origin: (origin, callback) => {
    logger.debug(`Request from origin : ${origin}`);
    const validOriginsRegexps = app.get('cors').validOrigins;
    let isOriginValid = false;
    if(!origin || (origin && Array.isArray(validOriginsRegexps))){
      let isOriginValid = (typeof origin === 'undefined');
      if(origin){
        for(const regexpString of validOriginsRegexps) {
          const regexp = new RegExp(regexpString);
          const match = regexp.exec(origin);
          if(match) {
            isOriginValid = true;
            break;
          }
        }
      }
      if(isOriginValid) {
        callback(null, true);
        return;
      }
    } else if (process.env.NODE_ENV === 'dev' || process.env.NODE_ENV === 'test' ) {
      callback(null, true);
      return;
    }
    const errorMessage = `${origin} is not an authorized origin.`;
    console.error(errorMessage)
    callback(new Error(errorMessage))
  }
}));
app.use(compress());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(favicon(path.join(app.get('public'), 'favicon.ico')));
// Host the public folder
app.use('/', express.static(app.get('public')));

// Set up Plugins and providers
app.configure(express.rest());
app.configure(socketio());

// Configure other middleware (see `middleware/index.js`)
app.configure(middleware);
// Set up our services (see `services/index.js`)
app.configure(services);
// Set up event channels (see channels.js)
app.configure(channels);

// Configure a middleware for 404s and the error handler
app.use(express.notFound());
app.use(express.errorHandler({ logger } as any));

app.hooks(appHooks);

export default app;
