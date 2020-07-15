import { NotAuthenticated } from "@feathersjs/errors";
// Application hooks that run for every service
// Don't remove this comment. It's needed to format import lines nicely.

export default {
  before: {
    all: [
      async (context:any) => {
        if(context.path !== 'authentication'){
          const authenticationService = context.app.service('authentication');
          const authenticationResult = await authenticationService.get(0);
          if(!authenticationResult) {
            throw new NotAuthenticated('You are not authorized to access this content or method. Please authenticate before using this application');
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
