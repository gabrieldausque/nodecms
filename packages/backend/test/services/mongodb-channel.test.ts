import * as assert from 'assert';
import app from '../../src/app';
import {Server} from "http";
import {globalInstancesFactory} from "@hermes/composition";
import {expect, getAuthenticationParams, initMongoDbTestDatabase} from "../../src/tests/TestsHelpers";
import axios from "axios";
import * as url from "url";
import {promisify} from "util";
import {Channel as ChannelEntity, ChannelVisibility} from "../../src/entities/Channel";
import {Channel} from "../../src/services/channel/channel.class";
import {ChannelPost} from "../../src/services/channel-post/channel-post.class";
import {Role} from "../../src/services/role/role.class";
import {v4 as uuid} from "uuid";

const port = app.get('port') || 8998;
const getUrl = (pathname?: string) => url.format({
  hostname: app.get('host') || 'localhost',
  protocol: 'http',
  port,
  pathname
});
const sleep = promisify(setTimeout);

describe('Channel service With Mongodb', () => {

  let server: Server;
  let params:any = {};
  let finalCookie = '';
  let clientUniqueId = uuid();
  let metadataStorage = globalInstancesFactory.getInstanceFromCatalogs('MetadataStorage','Default');

  before(async () => {
    await initMongoDbTestDatabase();
    server = app.listen(port);
    const p = new Promise((resolve => {
      server.once('listening', async () => {
        const authResponse = await axios.request({
          url: getUrl('authentication'),
          method: "POST",
          data: {
            login: "localtest",
            password: "apassword",
            clientUniqueId:clientUniqueId
          }
        })
        for(const cookie of authResponse.headers['set-cookie']) {
          const cookieString = cookie.split(';')[0];
          const cookieName = cookieString.split('=')[0];
          const cookieValue = cookieString.split('=')[1];
          switch(cookieName) {
            case 'ncms-uniqueid': {
              params.clientId = cookieValue
              break;
            }
            case 'ncms-token': {
              params.authenticationToken = cookieValue;
              break;
            }
            default: {
              params[cookieName] = cookieValue;
            }
          }
          finalCookie += `${cookieString}; `
        }
        resolve(undefined);
      });
    }))
    await p;
  })

  beforeEach(async () => {
    await initMongoDbTestDatabase();
    delete params.route
    delete params.lastIndex
  })

  after((done) => {
    server.close(done);
  })



  it('registered the service', () => {
    const service = app.service('channel');
    assert.ok(service, 'Registered the service');
  });

  it('should create a public channel and get its informations,', async() => {
    const service:Channel = app.service('channel');
    const roleService:Role = app.service('role');

    const created:Partial<ChannelEntity> = await service.create({
      visibility: ChannelVisibility.public,
      key: 'MyPublicChannel',
      label: 'A public channel',
    }, params);
    params.filter = {key:'channel-MyPublicChannel-readers'};
    const readersRole:any = await roleService.find(params);
    params.filter = {key:'channel-MyPublicChannel-contributors'};
    const contributorsRole:any = await roleService.find( params);
    params.filter = {key:'channel-MyPublicChannel-editors'};
    const editorsRole:any = await roleService.find( params);
    params.filter = {key:'channel-MyPublicChannel-administrators'};
    const administratorsRole:any = await roleService.find(params);
    expect(created).to.be.eql({
      id:1,
      key:'MyPublicChannel',
      visibility:ChannelVisibility.public,
      label: 'A public channel',
      readers:[readersRole[0].id],
      contributors:[contributorsRole[0].id],
      editors:[editorsRole[0].id],
      administrators:[administratorsRole[0].id]

    })
    let read = await service.get(created.id as number, params);
    expect(read).to.be.eql({ ...created, ...{"isContributor": true}});
  })

  it('should remove a public channel just created', async() => {
    const service:Channel = app.service('channel');
    const created:Partial<ChannelEntity> = await service.create({
      visibility: ChannelVisibility.public,
      key: 'MyPublicChannel',
      label: 'A public channel',
    }, params);
    const roleService:Role = app.service('role');
    params.filter = {key:'channel-MyPublicChannel-readers'};
    const readersRole:any = await roleService.find(params);
    params.filter = {key:'channel-MyPublicChannel-contributors'};
    const contributorsRole:any = await roleService.find( params);
    params.filter = {key:'channel-MyPublicChannel-editors'};
    const editorsRole:any = await roleService.find( params);
    params.filter = {key:'channel-MyPublicChannel-administrators'};
    const administratorsRole:any = await roleService.find(params);
    expect(created).to.be.eql({
      id:1,
      key:'MyPublicChannel',
      visibility:ChannelVisibility.public,
      label: 'A public channel',
      readers:[readersRole[0].id],
      contributors:[contributorsRole[0].id],
      editors:[editorsRole[0].id],
      administrators:[administratorsRole[0].id]
    })
    delete params.filter
    expect(await service.find(params)).to.be.eql([{
      administrators: [],
      contributors: [],
      editors: [],
      id: 0,
      key: "news",
      label: "Actualités",
      readers: [],
      visibility: "public",
      isContributor: true
    },{
        readers:[readersRole[0].id],
        contributors:[contributorsRole[0].id],
        editors:[editorsRole[0].id],
        administrators:[administratorsRole[0].id],
        id: 1,
        key: "MyPublicChannel",
        label: "A public channel",
        visibility: "public",
        isContributor: true
      }]);
    if(typeof created.id === 'number'){
      await service.remove(created.id, params);
      expect(await service.find(params)).to.be.eql([{
        readers:[],
        contributors:[],
        editors:[],
        administrators:[],
        id: 0,
        key: "news",
        label: "Actualités",
        visibility: "public",isContributor: true
      }]);
    } else {
      assert.fail('No id for created channel')
    }
  })

  it('should access to public post from public channel',async () => {
    const service:ChannelPost = app.service('channel/:channelNameOrId/posts');
    params.route = {
      channelNameOrId: 'news'
    };
    const posts:any = await service.find(params);
    expect([{
      author: posts[0].author.id,
      channelKey: posts[0].channelKey,
      content: posts[0].content,
      id: posts[0].id,
      tags: posts[0].tags
    }]).to.be.eql([{
      author: 0,
      channelKey: "news",
      content: "<h1> Bienvenue Sur le Channel news</h1><br>\n<div>Bienvenu sur le fil public des news du site communataire de l'Agence tous risques !</div>",
      id: 0,
      tags: [
        "Welcome"
      ]
    }])
  })

  it('should create a new public post on public channel',async () => {
    const service:ChannelPost = app.service('channel/:channelNameOrId/posts');
    params.route = {
      channelNameOrId: 'news'
    };
    const created = await service.create({
      content: "test de nouveau post"
    }, params);
    if(created.id)
      expect(await service.get(created.id as number, params)).to.be.eql(created);
    else
      assert.fail('No creation id');
  })

  it('should be able to update the channel', async() => {
    const service:Channel = app.service('channel');
    const created:Partial<ChannelEntity> = await service.create({
      visibility: ChannelVisibility.public,
      key: 'MyPublicChannel',
      label: 'A public channel',
    }, params);
    if(created.id){
      await service.update(created.id, {
        visibility: ChannelVisibility.protected,
        label: "My new label",
        readers:[1],
        contributors:[1],
        editors: [1],
        administrators:[0,1]
      }, params)
      expect(await service.get(created.id, params)).to.be.eql(
        {
          id: created.id,
          key: 'MyPublicChannel',
          visibility: ChannelVisibility.protected,
          label: "My new label",
          readers:[3,1],
          editors: [5,1],
          contributors:[4,1],
          administrators:[6,0,1],
          isContributor: true
        }
      );
      await service.patch(created.id, {
        visibility: ChannelVisibility.public,
        label: "My patch label",
        readers:[2],
        contributors:[2],
        editors: [2],
        administrators:[2]
      }, params)
      return expect(await service.get(created.id, params)).to.be.eql(
        {
          id: created.id,
          key: 'MyPublicChannel',
          visibility: ChannelVisibility.public,
          label: "My patch label",
          readers:[3,1,2],
          editors: [5,1,2],
          contributors:[4,1,2],
          administrators:[6,0,1,2],
          isContributor: true
        }
      )
    }
    assert.fail('No created id');
  })

  it('should return a children post correctly set', async() => {
      const service:ChannelPost = app.service('channel/:channelNameOrId/posts');
      params.route = {
        channelNameOrId: 'news'
      };
      const parentPost = await service.create({
        content: 'test'
      }, params);
      const childPost = await service.create({
        parentPost: parentPost.id,
        content:'test in child'
      }, params);
      if(typeof childPost.id === 'number'){
        const actual = await service.get(childPost.id, params);
        expect(childPost).to.be.eql(childPost);
        expect(childPost.parentPost).to.be.ok;
      } else {
        assert.fail('No created child post');
      }
  })

  it('should return all parent post for a channel without children post', async() => {
    const service:ChannelPost = app.service('channel/:channelNameOrId/posts');
    params.route = {
      channelNameOrId: 'news'
    };
    const parentPost = await service.create({
      content: 'test'
    }, params);
    const childPost = await service.create({
      parentPost: parentPost.id,
      content:'test in child'
    }, params);
    const posts:any = await service.find(params);
    if(Array.isArray(posts)){
       expect(posts.find(p => typeof p.parentPost !== 'undefined')).not.to.be.true;
    } else {
      assert.fail('not an array');
    }

  })

  it('should return all children post for a parent post', async() => {
    const service:ChannelPost = app.service('channel/:channelNameOrId/posts');
    params.route = {
      channelNameOrId: 'news'
    };
    const parentPost = await service.create({
      content: 'test'
    }, params);
    const childPost1 = await service.create({
      parentPost: parentPost.id,
      content:'test in child'
    }, params);
    const childPost2 = await service.create({
      parentPost: parentPost.id,
      content:'test in child 2'
    }, params);
    const posts:any = await service.find(params);
    if(Array.isArray(posts)){
      expect(posts.find(p => typeof p.parentPost !== 'undefined')).not.to.be.true;
    } else {
      assert.fail('not an array');
    }
  })

  it('should return first page containing 10 post and second page with 6 posts', async() => {
    const service:ChannelPost = app.service('channel/:channelNameOrId/posts');
    params.route = {
      channelNameOrId: 'news'
    };
    for(let postIndex = 0; postIndex < 15; postIndex++){
      await service.create({
        content:`this is the post ${postIndex}`
      }, params)
    }
    let page:any = await service.find(params);
    expect(page.length).to.eql(10);
    params.query = {
      lastIndex: page[page.length - 1].id
    };
    page = await service.find(params)
    expect(page.length).to.eql(6);
    expect(page[page.length - 1].id).to.eql(0);
  })

});
