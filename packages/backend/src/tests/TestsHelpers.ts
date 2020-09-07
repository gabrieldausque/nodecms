import url from "url";
import {promisify} from "util";

export function getUrl(pathname?: string, host?:string, port?:number):string {
  if(!port)
    port = 3030
  return url.format({
    hostname: host || 'localhost',
    protocol: 'http',
    port,
    pathname
  });
}
export const sleep = promisify(setTimeout);

import chai from 'chai';
chai.use(require('chai-as-promised'));
export {expect} from 'chai';
