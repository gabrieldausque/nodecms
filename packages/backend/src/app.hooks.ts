import {NotAcceptable, Forbidden, NotAuthenticated, NotImplemented, MethodNotAllowed} from "@feathersjs/errors";
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
    create: [],
    update: [async (context:any) => {
      const service:BaseService<any> = app.service(context.path) as BaseService<any>;
      if(!await service.isDataAuthorized(context.data, 'w',context.params.user)) {
        throw new Forbidden('Data asked is not authorized for your account');
      }
    }],
    patch: [async (context:any) => {
      const service:BaseService<any> = app.service(context.path) as BaseService<any>;
      if(!await service.isDataAuthorized(context.data, 'w',context.params.user)) {
        throw new Forbidden('Data asked is not authorized for your account');
      }
    }],
    remove: [async (context:any) => {
      const service:BaseService<any> = app.service(context.path) as BaseService<any>;
      const entity = await service.get(context.id,context.params);
      if(!await service.isDataAuthorized(entity, 'w',context.params.user)) {
        throw new Forbidden('Data asked is not authorized for your account');
      }
    }]
  },

  after: {
    all: [],
    find: [async (context:any) => {
      const service:BaseService<any> = app.service(context.path) as BaseService<any>;
      if(!await service.isDataAuthorized(context.result, 'r',context.params.user)) {
        throw new Forbidden('Data asked is not authorized for your account');
      }
    }],
    get: [async (context:any) => {
      const service:BaseService<any> = app.service(context.path) as BaseService<any>;
      if(!await service.isDataAuthorized(context.result, 'r',context.params.user)) {
        throw new Forbidden('Data asked is not authorized for your account');
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
