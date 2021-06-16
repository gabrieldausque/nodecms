import url from "url";
import {promisify} from "util";
const config = require('config');
import chai from 'chai';
import {MongoClient} from "mongodb";
import {MongoDbUserStorage} from "../plugins/Storages/User/MongoDbUserStorage";
import {globalInstancesFactory} from "@hermes/composition";
import {MongoDbAuthorizationStorage} from "../plugins/Storages/Authorization/MongoDbAuthorizationStorage";
import {MongoDbMetadataStorage} from "../plugins/Storages/Metadata/MongoDbMetadataStorage";
import {MongoDbRoleStorage} from "../plugins/Storages/Role/MongoDbRoleStorage";
import {EncryptionPlugin} from "../plugins/Encryption/EncryptionPlugin";
import axios from "axios";
import {MongoDbChannelStorage} from "../plugins/Storages/Channel/MongoDbChannelStorage";
import {MongoDbChannelPostStorage} from "../plugins/Storages/Channel/MongoDbChannelPostStorage";
import {ChannelVisibility} from "@nodecms/backend-data";
import {MongoDbDocumentStorage} from "../plugins/Storages/Document/MongoDbDocumentStorage";

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

export async function initMongoDbTestDatabase():Promise<void> {
  const encryption:EncryptionPlugin = globalInstancesFactory.getInstanceFromCatalogs('EncryptionPlugin','Default', config.get('authentication.encryption').configuration)
  const userStorage:MongoDbUserStorage = globalInstancesFactory.getInstanceFromCatalogs('UserStorage', 'MongoDb', config.get('storage.users').configuration);
  const authorizationStorage:MongoDbAuthorizationStorage = globalInstancesFactory.getInstanceFromCatalogs('AuthorizationStorage', 'MongoDb', config.get('storage.authorization').configuration);
  const metadataStorage:MongoDbMetadataStorage = globalInstancesFactory.getInstanceFromCatalogs('MetadataStorage', 'MongoDb', config.get('storage.metadata').configuration);
  const roleStorage:MongoDbRoleStorage = globalInstancesFactory.getInstanceFromCatalogs('RoleStorage', 'MongoDb',config.get('storage.roles').configuration);
  const channelStorage:MongoDbChannelStorage = globalInstancesFactory.getInstanceFromCatalogs('ChannelStorage', 'MongoDb', config.get('storage.channels').configuration);
  const channelPostStorage:MongoDbChannelPostStorage = globalInstancesFactory.getInstanceFromCatalogs('ChannelPostStorage', 'MongoDb', {...(config.get('storage.channelPosts').configuration)});
  const documentStorage:MongoDbDocumentStorage = globalInstancesFactory.getInstanceFromCatalogs('DocumentStorage', 'MongoDb', {...(config.get('storage.documents').configuration)});

  const mongoDbClient = new MongoClient("mongodb://root:Mbhj#ksf1445Mbfgqg@localhost:27017", {
    useUnifiedTopology:true
  });
  await mongoDbClient.connect();
  try {
    const teamATestDb = mongoDbClient.db('teama_test');
    try {
      await teamATestDb.addUser('admin_teama',
        'jfkbqsgbEGQ#dd54qfdgb',{
          roles: [{
            role: "readWrite",
            db: "teama_test"
          }]
        });
    }catch(err){
      //ignoring
    }
  }catch(err) {
    //ignoring
  }
  try {
    await mongoDbClient.db('teama_test').collection('users').drop();
  }catch(err) {
    //ignoring
  }

  try {
    await mongoDbClient.db('teama_test').collection('metadata').drop();
  }catch(err) {
    //ignoring
  }
  try {
    await mongoDbClient.db('teama_test').collection('authorizations').drop();
  }catch(err) {
    //ignoring
  }
  try {
    await mongoDbClient.db('teama_test').collection('roles').drop();
  }catch(err) {
    //ignoring
  }
  try {
    await mongoDbClient.db('teama_test').collection('counters').drop();
  }catch(err) {
    //ignoring
  }

  try {
    await mongoDbClient.db('teama_test').collection('channels').drop();
  }catch(err) {
    //ignoring
  }
  try {
    await mongoDbClient.db('teama_test').collection('channel#news').drop();
  }catch(err) {
    //ignoring
  }
  try {
    await mongoDbClient.db('teama_test').collection('media').drop();
  }catch(err) {
    //ignoring
  }
  try {
    await mongoDbClient.db('teama_test').collection('documents').drop();
  }catch(err) {
    //ignoring
  }

  try{
    await userStorage.create({ login:"localtest",password:"apassword",isActive:true});
  }catch(err){
    console.log('err during creation of user');
  }
  await userStorage.create({ login:"otheruser",password:"anotherpassword",isActive:true});
  await userStorage.create({ login:"standarduser", password:"standard", isActive:true})
  await userStorage.create({ login:"inactiveuser",password:"anything",isActive:false});
  await userStorage.create({ login:"otherAdmin",password:"otherAdmin",isActive:false});

  await roleStorage.create({ key:"administrators", description:"Administrators group", members:[0], ownerId:0, creationDate: new Date()});
  await roleStorage.create({ key:"specialUsers", description:"special Users group", members:[1], ownerId:0, creationDate: new Date()});
  await roleStorage.create({ key:"users", description:"Users group", members:[2,3,4], ownerId:0, creationDate: new Date()});

  await metadataStorage.create({ key:"title",value:"The A Team",isPublic:true,ownerType:undefined,ownerId:undefined});
  await metadataStorage.create({ key:"logo",value:"http://localhost:3030/a-team_logo.png",isPublic:true,ownerType:undefined,ownerId:undefined});
  await metadataStorage.create({ key:"private-metadata",value:"my private value",isPublic:false,ownerType:undefined,ownerId:undefined});
  await metadataStorage.create({ key:"pseudonym",value:"MyPseudo",isPublic:false,ownerType:"user",ownerId:0});

  await authorizationStorage.create({on:"operation",onType:"create",for:"*",right:"x",role:0});
  await authorizationStorage.create({on:"operation",onType:"update",for:"*",right:"x",role:0});
  await authorizationStorage.create({on:"operation",onType:"patch",for:"*",right:"x",role:0});
  await authorizationStorage.create({on:"operation",onType:"remove",for:"*",right:"x",role:0});
  await authorizationStorage.create({on:"operation",onType:"find",for:"*",right:"x",role:0});
  await authorizationStorage.create({on:"operation",onType:"get",for:"*",right:"x",role:0});

  //user service
  await authorizationStorage.create({on:"operation",onType:"update",for:"user",right:"x",role:1});
  await authorizationStorage.create({on:"operation",onType:"get",for:"user",right:"x",role:1});
  await authorizationStorage.create({on:"operation",onType:"find",for:"user",right:"x",role:1});
  await authorizationStorage.create({on:"operation",onType:"update",for:"user",right:"x",role:2});
  await authorizationStorage.create({on:"operation",onType:"get",for:"user",right:"x",role:2});
  await authorizationStorage.create({on:"operation",onType:"find",for:"user",right:"x",role:2});

  // role service
  await authorizationStorage.create({on:"operation",onType:"create",for:"role",right:"x",role:1});
  await authorizationStorage.create({on:"operation",onType:"create",for:"role",right:"x",role:2});
  await authorizationStorage.create({on:"operation",onType:"get",for:"role",right:"x",role:1});
  await authorizationStorage.create({on:"operation",onType:"get",for:"role",right:"x",role:2});
  await authorizationStorage.create({on:"operation",onType:"find",for:"role",right:"x",role:1});
  await authorizationStorage.create({on:"operation",onType:"find",for:"role",right:"x",role:2});
  await authorizationStorage.create({on:"operation",onType:"update",for:"role",right:"x",role:1});
  await authorizationStorage.create({on:"operation",onType:"update",for:"role",right:"x",role:2});

  //channel and channel posts service
  await authorizationStorage.create({on:"operation",onType:"create",for:"channel-posts",right:"x",role:1});
  await authorizationStorage.create({on:"operation",onType:"create",for:"channel-posts",right:"x",role:2});
  await authorizationStorage.create({on:"operation",onType:"remove",for:"channel-posts",right:"x",role:1});
  await authorizationStorage.create({on:"operation",onType:"remove",for:"channel-posts",right:"x",role:2});
  await authorizationStorage.create({on:"operation",onType:"update",for:"channel-posts",right:"x",role:1});
  await authorizationStorage.create({on:"operation",onType:"update",for:"channel-posts",right:"x",role:2});
  await authorizationStorage.create({on:"operation",onType:"get",for:"channel-posts",right:"x",role:1});
  await authorizationStorage.create({on:"operation",onType:"get",for:"channel-posts",right:"x",role:2});
  await authorizationStorage.create({on:"operation",onType:"find",for:"channel-posts",right:"x",role:1});
  await authorizationStorage.create({on:"operation",onType:"find",for:"channel-posts",right:"x",role:2});

  //Rights for Document service
  await authorizationStorage.create({on:"operation",onType:"get",for:"document",right:"x",role:1});
  await authorizationStorage.create({on:"operation",onType:"get",for:"document",right:"x",role:2});
  await authorizationStorage.create({on:"operation",onType:"find",for:"document",right:"x",role:1});
  await authorizationStorage.create({on:"operation",onType:"find",for:"document",right:"x",role:2});
  await authorizationStorage.create({on:"operation",onType:"create",for:"document",right:"x",role:1});
  await authorizationStorage.create({on:"operation",onType:"remove",for:"document",right:"x",role:1});
  await authorizationStorage.create({on:"operation",onType:"update",for:"document",right:"x",role:1});

  await authorizationStorage.create({on:"data",onType:"role",for:"*",right:"r",role:0});
  await authorizationStorage.create({on:"data",onType:"role",for:"*",right:"r",role:1});
  await authorizationStorage.create({on:"data",onType:"role",for:"*",right:"r",role:2});
  await authorizationStorage.create({on:"data",onType:"role",for:"*",right:"w",role:0});
  await authorizationStorage.create({on:"data",onType:"metadata",for:"*",right:"r",role:0});
  await authorizationStorage.create({on:"data",onType:"metadata",for:"*",right:"w",role:0});
  await authorizationStorage.create({on:"data",onType:"user",for:"*",right:"r",role:0});
  await authorizationStorage.create({on:"data",onType:"user",for:"*",right:"w",role:0});

  await channelStorage.create({ key:'news', label:'Actualités', visibility:ChannelVisibility.public});

  await channelPostStorage.create({ author:0,
    channelKey:'news',
    content:`<h1> Bienvenue Sur le Channel news</h1><br>
<div>Bienvenu sur le fil public des news du site communataire de l'Agence tous risques !</div>`,
    tags:['Welcome']
  }, 'news');

  await documentStorage.create({
    ownerId:0,
    readers: [],
    documentType: 'default',
    readerRoles: [],
    editors: [],
    editorRoles: [],
    visibility: 'public',
    content: { prop: 'MyContentProp'},
    key: 'welcome',
    creationDate: new Date(),
    updateDate: new Date()
  })

  await documentStorage.create({
    ownerId:0,
    readers: [],
    documentType: 'default',
    readerRoles: [],
    editors: [],
    editorRoles: [1],
    visibility: 'protected',
    content: { prop: 'MyContentPropProtected'},
    key: 'welcomeProtected',
    creationDate: new Date(),
    updateDate: new Date()
  })

  await documentStorage.create({
    ownerId:0,
    readers: [],
    documentType: 'default',
    readerRoles: [1],
    editors: [],
    editorRoles: [0],
    visibility: 'private',
    content: { prop: 'MyContentPropPrivate'},
    key: 'welcomePrivate',
    creationDate: new Date(),
    updateDate: new Date()
  })
}

export const getAuthenticationParams = async (login:string, password:string, serverPort:number, clientUniqueId:string) => {
  const authResponse = await axios.request({
    url: getUrl('authentication', 'localhost', serverPort),
    method: "POST",
    data: {
      login: login,
      password: password,
      clientUniqueId: clientUniqueId
    }
  })
  const authParams:any = {};
  for(const cookie of authResponse.headers['set-cookie']) {
    const cookieString = cookie.split(';')[0];
    const cookieName = cookieString.split('=')[0];
    const cookieValue = cookieString.split('=')[1];
    switch(cookieName) {
      case 'ncms-uniqueid': {
        authParams.clientId = cookieValue
        break;
      }
      case 'ncms-token': {
        authParams.authenticationToken = cookieValue;
        break;
      }
      default: {
        authParams[cookieName] = cookieValue;
      }
    }
  }
  return authParams;
}

chai.use(require('chai-as-promised'));
export {expect} from 'chai';
