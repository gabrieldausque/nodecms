import { Application } from '../declarations';
import authentication from './authentication/authentication.service';
// Don't remove this comment. It's needed to format import lines nicely.

export default function (app: Application) {
  app.configure(authentication);
}
