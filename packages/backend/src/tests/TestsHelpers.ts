import url from "url";
import {promisify} from "util";

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
  const userStorage:MongoDbUserStorage = globalInstancesFactory.getInstanceFromCatalogs('UserStorage', 'MongoDb');
  const authorizationStorage:MongoDbAuthorizationStorage = globalInstancesFactory.getInstanceFromCatalogs('AuthorizationStorage', 'MongoDb');
  const metadataStorage:MongoDbMetadataStorage = globalInstancesFactory.getInstanceFromCatalogs('MetadataStorage', 'MongoDb');
  const roleStorage:MongoDbRoleStorage = globalInstancesFactory.getInstanceFromCatalogs('RoleStorage', 'MongoDb');

  const mongoDbClient = new MongoClient("mongodb://admin_teama:admin@localhost:27017");
  await mongoDbClient.connect();
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

  await roleStorage.create({ key:"administrators", description:"Administrators group"});
  await roleStorage.create({ key:"users", description:"Users group"});
  await roleStorage.create({ key:"specialUsers", description:"special Users group"});

  await userStorage.create({ login:"localtest",password:"apassword",isActive:true});
  await userStorage.create({ login:"otheruser",password:"anotherpassword",isActive:true});
  await userStorage.create({ login:"inactiveuser",password:"anything",isActive:false});

  await metadataStorage.create({ key:"title",value:"The A Team",isPublic:true,ownerType:undefined,ownerId:undefined});
  await metadataStorage.create({ key:"logo",value:"http://localhost:3030/a-team_logo.png",isPublic:true,ownerType:undefined,ownerId:undefined});
  await metadataStorage.create({ key:"private-metadata",value:"my private value",isPublic:false,ownerType:undefined,ownerId:undefined});
  await metadataStorage.create({ key:"pseudonym",value:"MyPseudo",isPublic:false,ownerType:"user",ownerId:0});
  await metadataStorage.create({ key:"roles",value:[0,2],isPublic:false,ownerType:"user",ownerId:0});

  await authorizationStorage.create({on:"operation",onType:"create",for:"*",right:"x",role:0});
  await authorizationStorage.create({on:"operation",onType:"update",for:"*",right:"x",role:0});
  await authorizationStorage.create({on:"operation",onType:"patch",for:"*",right:"x",role:0});
  await authorizationStorage.create({on:"operation",onType:"remove",for:"*",right:"x",role:0});
  await authorizationStorage.create({on:"operation",onType:"find",for:"*",right:"x",role:0});
  await authorizationStorage.create({on:"operation",onType:"get",for:"*",right:"x",role:0});
  await authorizationStorage.create({on:"operation",onType:"remove",for:"user",right:"x",role:1});
  await authorizationStorage.create({on:"data",onType:"role",for:"*",right:"r",role:0});
  await authorizationStorage.create({on:"data",onType:"role",for:"*",right:"r",role:1});
  await authorizationStorage.create({on:"data",onType:"role",for:"*",right:"w",role:0});
  await authorizationStorage.create({on:"data",onType:"metadata",for:"*",right:"r",role:0});
  await authorizationStorage.create({on:"data",onType:"metadata",for:"*",right:"w",role:0});
  await authorizationStorage.create({on:"data",onType:"user",for:"*",right:"r",role:0});
  await authorizationStorage.create({on:"data",onType:"user",for:"*",right:"w",role:0});
}

import chai from 'chai';
import {MongoClient} from "mongodb";
import {MongoDbUserStorage} from "../plugins/Storages/User/MongoDbUserStorage";
import {globalInstancesFactory} from "@hermes/composition";
import {MongoDbAuthorizationStorage} from "../plugins/Storages/Authorization/MongoDbAuthorizationStorage";
import {MongoDbMetadataStorage} from "../plugins/Storages/Metadata/MongoDbMetadataStorage";
import {MongoDbRoleStorage} from "../plugins/Storages/Role/MongoDbRoleStorage";
chai.use(require('chai-as-promised'));
export {expect} from 'chai';
