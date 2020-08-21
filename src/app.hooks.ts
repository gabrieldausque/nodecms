import {NotAcceptable, NotAuthenticated} from "@feathersjs/errors";
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
          const authenticationService = context.app.service('authentication');
          if(!await authenticationService.get(authenticationService.encryptor.decryptUniqueId(context.params.clientId))) {
            throw new NotAuthenticated('Please authenticate before using this application');
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
