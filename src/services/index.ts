import { Application } from '../declarations';
import authentication from './authentication/authentication.service';
import document from './document/document.service';
// Don't remove this comment. It's needed to format import lines nicely.

export default function (app: Application) {
  app.configure(authentication);
  app.configure(document);
}
