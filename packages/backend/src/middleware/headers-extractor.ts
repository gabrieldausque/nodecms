import { Request, Response, NextFunction } from 'express';

export default () => {
  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  return (req: Request, res: Response, next: NextFunction) => {
    const request = req as any;
    if(request.feathers){
      if(request.feathers.headers){

        //parse the cookie to set parameters
        let cookie:any = {};
        if(request.feathers.headers['cookie']) {
          request.feathers.headers['cookie'].split(';').map((cookieFieldLiteral:string) => {
            const cookieField = cookieFieldLiteral.split('=');
            if(cookieField.length >= 2){
              const cookieFieldName:string = cookieField[0].trim();
              const cookieFieldValue:string = cookieField[1].trim();
              cookie[cookieFieldName] = cookieFieldValue;
            }
          })
        }

        if(cookie['ncms-uniqueid'])
          request.feathers.clientId = cookie['ncms-uniqueid']

        if(cookie['ncms-token']) {
          request.feathers.authenticationToken = cookie['ncms-token']
        }

        if(cookie['realm']) {
          request.feathers.realm = cookie['realm'];
        }

      }
    }
    next();
  };
}
//@ts-ignore
