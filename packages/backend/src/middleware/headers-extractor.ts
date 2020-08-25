import { Request, Response, NextFunction } from 'express';

export default () => {
  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  return (req: Request, res: Response, next: NextFunction) => {
    const request = req as any;
    if(request.feathers){
      if(request.feathers.headers){

        if(request.feathers.headers['ncms-uniqueid'])
          request.feathers.clientId = request.feathers.headers['ncms-uniqueid']

        if(request.feathers.headers['www-authenticate']) {
          const regexp = /Bearer[ ]+realm=(?<realm>[^ ]+)/g
          const match = regexp.exec(request.feathers.headers['www-authenticate']);
          if(match && match.groups && match.groups.realm) {
            request.feathers.realm = match.groups.realm;
          }
        }

      }
    }
    next();
  };
}
//@ts-ignore
