import {Application} from "../declarations";
import {NotAcceptable, NotAuthenticated, NotImplemented} from "@feathersjs/errors";
import app from "../app";

export abstract class BaseService {

  app: Application;

  protected constructor(app:Application) {
    this.app = app;
  }

  abstract needAuthentication(context:any):boolean;

  abstract isAuthorized(context:any):boolean

  abstract isDataAuthorized(data:any):boolean;

  async validAuthentication(params:any) {
    if(!params.clientId){
      throw new NotAcceptable('You are missing your unique clientId. Please correct and retry.');
    }

    if(!params.realm) {
      throw new NotAcceptable('No realm specified, authentication can\'t be checked. Please authenticate.');
    }

    if(params.realm !== app.get('authentication').realm) {
      // TODO : if not local authority keys, call other www-authenticate realm to check token
      throw new NotImplemented('Federation of authentication not implemented. Will be done in further release');
    } else {
      const authenticationService = this.app.service('authentication');
      if(!await authenticationService.get(authenticationService.encryptor.decryptClientId(params.clientId), params)) {
        throw new NotAuthenticated('Please authenticate before using this application');
      }
    }
  }
}
