import { Application } from '../declarations';
import authentication from './authentication/authentication.service';
import document from './document/document.service';
import swagger from 'feathers-swagger';
import metadata from './metadata/metadata.service';
import user from './user/user.service';
import role from './role/role.service';
import userRoles from './user-roles/user-roles.service';
import userMetadata from './user-metadata/user-metadata.service';
import authorization from './authorization/authorization.service';
import channel from './channel/channel.service';
import channelPost from './channel-post/channel-post.service';
import media from './media/media.service';
import webthumbnail from './webthumbnail/webthumbnail.service';
// Don't remove this comment. It's needed to format import lines nicely.

export default function (app: Application) {
  configureSwagger(app);
  app.configure(metadata);
  app.configure(role);
  app.configure(user);
  app.configure(userMetadata);
  app.configure(userRoles);
  app.configure(authentication);
  app.configure(authorization);
  app.configure(document);
  app.configure(channel);
  app.configure(channelPost);
  app.configure(media);
  app.configure(webthumbnail);
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
        '^authorization',
        '^role',
        '^user',
        '^metadata',
        '^document',
        '^channel',
        '^media'
      ]
    }
  }));
}
