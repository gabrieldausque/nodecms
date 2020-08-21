import { Request, Response, NextFunction } from 'express';
import app from '../app';

export default () => {
  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  return (req: Request, res: Response, next: NextFunction) => {
    const request = req as any;
    if(request.feathers){
      if(request.feathers.headers && request.feathers.headers['ncms-uniqueid']){
        request.feathers.clientId = request.feathers.headers['ncms-uniqueid']
      }
    }
    next();
  };
}
