import {NotAcceptable, NotAuthenticated, NotImplemented} from "@feathersjs/errors";
import app from "./app";
import {BaseService} from "./services/BaseService";
import Base = Mocha.reporters.Base;
// Application hooks that run for every service
// Don't remove this comment. It's needed to format import lines nicely.

export default {
  before: {
    all: [
      async (context:any) => {
        const service:BaseService<any> = app.service(context.path) as BaseService<any>;
        if(service.needAuthentication(context) && service.isAuthorized(context)) {
          await service.validAuthentication(context.params);
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
    all: [ async (context:any) => {
      const service:BaseService<any> = app.service(context.path) as BaseService<any>;
      if(service.isDataAuthorized(context.response)) {
        return context.response;
      }
    }],
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
