import { Application } from '../declarations';
import authentication from './authentication/authentication.service';
import document from './document/document.service';
import swagger from 'feathers-swagger';
import metadata from './metadata/metadata.service';
import user from './user/user.service';
import role from './role/role.service';
// Don't remove this comment. It's needed to format import lines nicely.

export default function (app: Application) {
  configureSwagger(app);
  app.configure(authentication);
  app.configure(metadata);
  app.configure(role);
  app.configure(user);
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
        '^document',
        '^user',
        '^metadata'
      ]
    }
  }));
}
