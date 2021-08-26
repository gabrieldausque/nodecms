import { Application } from '../declarations';
import headersExtractor from './headers-extractor';
// Don't remove this comment. It's needed to format import lines nicely.

export default function (app: Application) {
  app.use(headersExtractor());
}
