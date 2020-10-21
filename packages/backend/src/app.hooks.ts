import {NotAcceptable, NotAuthenticated, NotImplemented, MethodNotAllowed} from "@feathersjs/errors";
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
        if(service.needAuthentication(context)) {
          await service.validAuthentication(context.params);
          if(!(await service.isAuthorized(context))) {
            throw new MethodNotAllowed();
          }
        }
      }
    ],
    find: [],
    get: [],
    create: [async (context:any) => {
      const service:BaseService<any> = app.service(context.path) as BaseService<any>;
      if(await service.isDataAuthorized(context.result, 'w',context.params.user)) {
        return context.result;
      }
    }],
    update: [async (context:any) => {
      const service:BaseService<any> = app.service(context.path) as BaseService<any>;
      if(await service.isDataAuthorized(context.result, 'w',context.params.user)) {
        return context.result;
      }
    }],
    patch: [async (context:any) => {
      const service:BaseService<any> = app.service(context.path) as BaseService<any>;
      if(await service.isDataAuthorized(context.result, 'w',context.params.user)) {
        return context.result;
      }
    }],
    remove: [async (context:any) => {
      const service:BaseService<any> = app.service(context.path) as BaseService<any>;
      if(await service.isDataAuthorized(context.result, 'w',context.params.user)) {
        return context.result;
      }
    }]
  },

  after: {
    all: [],
    find: [async (context:any) => {
      const service:BaseService<any> = app.service(context.path) as BaseService<any>;
      if(await service.isDataAuthorized(context.result, 'r',context.params.user)) {
        return context.result;
      }
    }],
    get: [async (context:any) => {
      const service:BaseService<any> = app.service(context.path) as BaseService<any>;
      if(await service.isDataAuthorized(context.result, 'r',context.params.user)) {
        return context.result;
      }
    }],
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
