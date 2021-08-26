import {
  NotAcceptable,
  Forbidden,
  NotAuthenticated,
  NotImplemented,
  MethodNotAllowed,
  NotFound
} from "@feathersjs/errors";
import app from "./app";
import {BaseService} from "./services/BaseService";
import Base = Mocha.reporters.Base;
// Application hooks that run for every service
// Don't remove this comment. It's needed to format import lines nicely.

export default {
  before: {
    all: [
      async (context:any) => {
        try{
          const service:BaseService<any,any, any> = app.service(context.path) as BaseService<any,any, any>;
          if(await service.needAuthentication(context)) {
            await service.validAuthentication(context.params);
            if(!(await service.isAuthorized(context))) {
              throw new MethodNotAllowed(`Method ${context.method} for service ${service.serviceLabel} is not authorized for user ${context?.params?.user?.login}`);
            }
          }
        }catch(error){
          if(error instanceof NotAuthenticated ||
          error instanceof NotImplemented ||
          error instanceof NotAcceptable ||
          error instanceof NotFound ||
          error instanceof MethodNotAllowed){
            throw error;
          } else if(typeof error === 'string')
           throw new MethodNotAllowed(error)
         else if(error instanceof Error){
           throw new MethodNotAllowed(error.message);
         }
         throw new MethodNotAllowed(`Unknown error during before hook : ${error}`);
        }
      }
    ],
    find: [],
    get: [],
    create: [],
    update: [async (context:any) => {
      const service:BaseService<any,any,any> = app.service(context.path) as BaseService<any,any,any>;
      if(typeof context.id === "undefined" || context.id === null){
        throw new Forbidden('No id send for update request. Please send id with updated entity');
      }
      const entity = await service.get(context.id,context.params);
      if(!await service.isDataAuthorized(entity, 'w',context.params.user)) {
        throw new Forbidden('Data to update is not authorized for your account');
      }
    }],
    patch: [async (context:any) => {
      const service:BaseService<any,any,any> = app.service(context.path) as BaseService<any,any,any>;
      if(typeof context.id === "undefined" || context.id === null){
        throw new Forbidden('No id send for update request. Please send id with updated entity');
      }
      const entity = await service.get(context.id,context.params);
      if(!await service.isDataAuthorized(entity, 'w',context.params.user)) {
        throw new Forbidden('Data to patch is not authorized for your account');
      }
    }],
    remove: [async (context:any) => {
      const service:BaseService<any,any,any> = app.service(context.path) as BaseService<any,any,any>;
      const entity = await service.get(context.id,context.params);
      if(!await service.isDataAuthorized(entity, 'w',context.params.user)) {
        throw new Forbidden('Data to remove is not authorized for your account');
      }
    }]
  },

  after: {
    all: [],
    find: [async (context:any) => {
      const service:BaseService<any,any,any> = app.service(context.path) as BaseService<any,any,any>;
      if(Array.isArray(context.result)){
        const toCheck = [...context.result]
        for(const data of toCheck) {
          if(!await service.isDataAuthorized(data, 'r', context.params.user)){
            context.result.splice(context.result.indexOf(data),1);
          }
        }
      }
    }],
    get: [async (context:any) => {
      const service:BaseService<any,any,any> = app.service(context.path) as BaseService<any,any,any>;
      if(!await service.isDataAuthorized(context.result, 'r',context.params.user)) {
        throw new Forbidden(`Data asked for service ${context.path} is not authorized for your account`);
      }
    }],
    create: [],
    update: [],
    patch: [],
    remove: []
  },

  error: {
    all: [async (context:any) => {
      console.log('error');
    }],
    find: [],
    get: [],
    create: [],
    update: [],
    patch: [],
    remove: []
  }
};
