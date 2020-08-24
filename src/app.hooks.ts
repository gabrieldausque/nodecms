import {NotAcceptable, NotAuthenticated, NotImplemented} from "@feathersjs/errors";
import app from "./app";
// Application hooks that run for every service
// Don't remove this comment. It's needed to format import lines nicely.

export default {
  before: {
    all: [
      async (context:any) => {
        if(context.path !== 'authentication'){
          if(!context.params.clientId){
            throw new NotAcceptable('You are missing your unique clientId. Please correct and retry.');
          }
          if(!context.params.realm) {
            throw new NotAcceptable('No realm specified, authentication can\'t be checked. Please authenticate.');
          }

          if(context.params.realm !== app.get('authentication').realm) {
            // TODO : if not local authority keys, call other www-authenticate realm to check token
            throw new NotImplemented('Federation of authentication not implemented. Will be done in further release');
          } else {
            const authenticationService = context.app.service('authentication');
            if(!await authenticationService.get(authenticationService.encryptor.decryptClientId(context.params.clientId))) {
              throw new NotAuthenticated('Please authenticate before using this application');
            }
          }
        }
      }
    ],
    find: [],
    get: [],
    create: [],
    update: [],
    patch: [],
    remove: []
  },

  after: {
    all: [],
    find: [],
    get: [],
    create: [],
    update: [],
    patch: [],
    remove: []
  },

  error: {
    all: [],
    find: [],
    get: [],
    create: [],
    update: [],
    patch: [],
    remove: []
  }
};
