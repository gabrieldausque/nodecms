import { Application } from '../declarations';
import authentication from './authentication/authentication.service';
import document from './document/document.service';
import swagger from 'feathers-swagger';
// Don't remove this comment. It's needed to format import lines nicely.

export default function (app: Application) {
  configureSwagger(app);
  app.configure(authentication);
  app.configure(document);

}

function configureSwagger(app: Application): void {
  console.log('configuring swagger for app');
  app.configure(swagger({
    openApiVersion: 3,
    docsPath: '/swagger',
    prefix: 'v3/definitions/',
    docsJsonPath: '/swagger.json',
    uiIndex: true,
    specs: {
      info: {
        title: 'NodeCMS',
        description: 'Description of services',
        version: '1.0.0',
      }
    },
    include: {
      paths: [
        '^authentication',
        '^document'
      ]
    }
  }));
}
