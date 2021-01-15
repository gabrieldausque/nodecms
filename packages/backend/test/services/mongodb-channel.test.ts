
// @ts-ignore
import assert from 'assert';
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
  let metadataStorage = globalInstancesFactory.getInstanceFromCatalogs('MetadataStorage','Default');

  before(async () => {
    await initMongoDbTestDatabase();
    server = app.listen(port);
    server.once('listening', async () => {
      const authResponse = await axios.request({
        url: getUrl('authentication'),
        method: "POST",
        data: {
          login: "localtest",
          password: "apassword",
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
    });
  })

  beforeEach(async () => {
    await initMongoDbTestDatabase();
    params.route = {};
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
    expect(await service.get(created.id as number, params)).to.be.eql(created);
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
      visibility: "public"
    },{
        readers:[readersRole[0].id],
        contributors:[contributorsRole[0].id],
        editors:[editorsRole[0].id],
        administrators:[administratorsRole[0].id],
        id: 1,
        key: "MyPublicChannel",
        label: "A public channel",
        visibility: "public"
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
        visibility: "public"
      }]);
    } else {
      assert.fail('No id for created channel')
    }
  })

  it('should access to public post from public channel',async () => {
    const service:ChannelPost = app.service('channel/:channelNameOrId/posts');
    params.route.channelNameOrId = 'news';
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
    params.route.channelNameOrId = 'news';
    const created = await service.create({
      content: "test de nouveau post"
    }, params);
    if(created.id)
      expect(await service.get(created.id as number, params)).to.be.eql(created);
    else
      assert.fail('No creation id');
  })

  it('should reject post from a non contributors user on public channel', async() => {
    const service:ChannelPost = app.service('channel/:channelNameOrId/posts');
    const anotherUserParams:any = await getAuthenticationParams('otheruser', 'anotherpassword', port);
    anotherUserParams.route = {
      channelNameOrId : 'news'
    }
    const creationPromise = service.create({
      content: "test de nouveau post"
    }, anotherUserParams);
    return expect(creationPromise).to.be.rejectedWith('User otheruser is not a member or has not sufficient rights to execute undefined on channel news');
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
          administrators:[6,0,1]
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
          administrators:[6,0,1,2]
        }
      )
    }
    assert.fail('No created id');
  })

});
