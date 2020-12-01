
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
    const created:ChannelEntity = await service.create({
      visibility: ChannelVisibility.public,
      key: 'MyPublicChannel',
      label: 'A public channel',
    }, params);
    expect(created).to.be.eql({
      id:0,
      key:'MyPublicChannel',
      visibility:ChannelVisibility.public,
      label: 'A public channel',
      readers:[],
      contributors:[],
      editors:[],
      administrators:[0]
    })
    expect(await service.get(created.id as number, params)).to.be.eql(created);
  })

  it('should access to public post from public channel',async () => {
    const service:ChannelPost = app.service('channel/:channelNameOrId/posts');
    params.route.channelNameOrId = 'news';
    const posts = await service.find(params);
    expect(posts).to.be.eql([{
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

});
