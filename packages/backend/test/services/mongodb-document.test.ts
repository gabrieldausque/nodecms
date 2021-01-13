import * as assert from 'assert';
import app from '../../src/app';
import {expect, getAuthenticationParams, getUrl, initMongoDbTestDatabase} from '../../src/tests/TestsHelpers'
import {Server} from "http";
import axios from "axios";
import {globalInstancesFactory} from "@hermes/composition";
import {Document} from "../../src/services/document/document.class"
import {Document as DocumentEntity} from "../../src/entities/Document"
const port = app.get('port') || 3030;

describe('Document service', () => {

  let server: Server;
  let finalCookie = '';
  let params:any = {};

  before(async () => {
    await initMongoDbTestDatabase();
    server = app.listen(port);

    server.once('listening', async () => {
      const authResponse = await axios.request({
        url: getUrl('authentication', 'localhost', port),
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
  })

  after((done) => {
    server.close(done);
  })

  it('registered the service', () => {
    const service = app.service('document');
    assert.ok(service, 'Registered the service');
  });

  it('should create a public document', async () => {
    const service:Document = app.service('document');
    const created = await service.create({
      key: 'NewDocument',
      content: {
        aProperty: "this is a property of the document"
      }
    }, params);
    params.query = {
      key: 'NewDocument'
    };
    const gotten:any = await service.find(params);
    expect(created).to.be.eql(gotten[0])
  })

  it('should remove a document', async () => {
    const service:Document = app.service('document');
    const created = await service.create({
      key: 'NewDocument',
      content: {
        aProperty: "this is a property of the document"
      }
    }, params);
    params.query = {
      key: 'NewDocument'
    };
    let gotten:any = await service.find(params);
    expect(created).to.be.eql(gotten[0])
    if(typeof created.id === 'number'){
      const deleted = await service.remove(created.id, params)
      expect(created).to.be.eql(deleted)
      gotten = await service.find(params);
      expect(gotten.length).to.be.eql(0);
    }else {
      assert.fail('No id in created');
    }

  })

  it('should get public document without authentication', async() => {
    const service:Document = app.service('document');
    const publicDoc = await service.get(0);
    expect(publicDoc).to.eql({
      id: 0,
      ownerId:0,
      readers: [],
      documentType: 'default',
      readerRoles: [],
      editors: [],
      editorRoles: [],
      visibility: 'public',
      content: { prop: 'MyContentProp'},
      key: 'welcome'
    })
  })

  it('should throw error if trying to get protected document without authentication', async() => {
    const service:Document = app.service('document');
    const protectedDocPromise = service.get(1);
    return expect(protectedDocPromise).to.be.rejectedWith('You are missing your unique clientId. Please correct and retry');
  })

  it('should get protected document with non admin authentication', async() => {
    const service:Document = app.service('document');
    const standardUserParam = await getAuthenticationParams('standarduser', 'standard', port);
    const protectedDoc = await service.get(1, standardUserParam);
    return expect(protectedDoc).to.be.eql({
      id:1,
      ownerId:0,
      readers: [],
      documentType: 'default',
      readerRoles: [],
      editors: [],
      editorRoles: [1],
      visibility: 'protected',
      content: { prop: 'MyContentPropProtected'},
      key: 'welcomeProtected'
    })
  })

  it('should throw error if trying to get private document without authentication', async() => {
    const service:Document = app.service('document');
    const protectedDocPromise = service.get(2);
    return expect(protectedDocPromise).to.be.rejectedWith('You are missing your unique clientId. Please correct and retry.');
  })

  it('should throw error if trying to get private document with not authorized authentication', async() => {
    const service:Document = app.service('document');
    const standardUserParam = await getAuthenticationParams('standarduser', 'standard', port);
    const protectedDocPromise = service.get(2, standardUserParam);
    return expect(protectedDocPromise).to.be.rejectedWith('User standarduser is not authorized to access document with id 2');
  })

  it('should get private document with authorized non admin authentication', async() => {
    const service:Document = app.service('document');
    const otherUserParams = await getAuthenticationParams('otheruser', 'anotherpassword', port);
    const protectedDoc = await service.get(2, otherUserParams);
    return expect(protectedDoc).to.be.eql({
      id:2,
      ownerId:0,
      readers: [],
      documentType: 'default',
      readerRoles: [1],
      editors: [],
      editorRoles: [0],
      visibility: 'private',
      content: { prop: 'MyContentPropPrivate'},
      key: 'welcomePrivate'
    });
  })

  it('should get private document with admin authentication', async() => {
    const service:Document = app.service('document');
    const protectedDoc = await service.get(2, params);
    return expect(protectedDoc).to.be.eql({
      id:2,
      ownerId:0,
      readers: [],
      documentType: 'default',
      readerRoles: [1],
      editors: [],
      editorRoles: [0],
      visibility: 'private',
      content: { prop: 'MyContentPropPrivate'},
      key: 'welcomePrivate'
    });
  })

  it('should find all public documents without authentication', async() => {
    const service:Document = app.service('document');
    const protectedDocs:any = await service.find({
      query:{
        ownerId:0,
        visibility:'public'
      }
    });
    return Promise.all([
      expect(protectedDocs.length).to.be.eql(1),
      expect(protectedDocs[0]).to.be.eql({
        id:0,
        ownerId:0,
        readers: [],
        documentType: 'default',
        readerRoles: [],
        editors: [],
        editorRoles: [],
        visibility: 'public',
        content: { prop: 'MyContentProp'},
        key: 'welcome'
      })
    ])
  })

  it('should find all authorized documents with limited authentication', async() => {
    const service:Document = app.service('document');
    const standardUserParam = await getAuthenticationParams('standarduser', 'standard', port);
    standardUserParam.query = {
      ownerId:0
    };
    const protectedDocs:any = await service.find(standardUserParam);
    return Promise.all([
      expect(protectedDocs.length).to.be.eql(2),
      expect(protectedDocs).to.be.eql([{
        id:0,
        ownerId:0,
        readers: [],
        documentType: 'default',
        readerRoles: [],
        editors: [],
        editorRoles: [],
        visibility: 'public',
        content: { prop: 'MyContentProp'},
        key: 'welcome'
      },{
        id:1,
        ownerId:0,
        readers: [],
        documentType: 'default',
        readerRoles: [],
        editors: [],
        editorRoles: [1],
        visibility: 'protected',
        content: { prop: 'MyContentPropProtected'},
        key: 'welcomeProtected'
      }])
    ])
  })

  it('should find all authorized documents with extended authentication', async() => {
    const service:Document = app.service('document');
    const specialUserParam = await getAuthenticationParams('otheruser', 'anotherpassword', port);
    specialUserParam.query = {
      ownerId:0
    };
    const protectedDocs:any = await service.find(specialUserParam);
    return Promise.all([
      expect(protectedDocs.length).to.be.eql(3),
      expect(protectedDocs).to.be.eql([{
        id:0,
        ownerId:0,
        readers: [],
        documentType: 'default',
        readerRoles: [],
        editors: [],
        editorRoles: [],
        visibility: 'public',
        content: { prop: 'MyContentProp'},
        key: 'welcome'
      },{
        id:1,
        ownerId:0,
        readers: [],
        documentType: 'default',
        readerRoles: [],
        editors: [],
        editorRoles: [1],
        visibility: 'protected',
        content: { prop: 'MyContentPropProtected'},
        key: 'welcomeProtected'
      },{
        id:2,
        ownerId:0,
        readers: [],
        documentType: 'default',
        readerRoles: [1],
        editors: [],
        editorRoles: [0],
        visibility: 'private',
        content: { prop: 'MyContentPropPrivate'},
        key: 'welcomePrivate'
      }])
    ])
  })

  it('should throw error when trying to update a document without authentication', async() => {
    const service:Document = app.service('document');
    return expect(service.update(0,{
      visibility:'private'
    })).to.be.rejectedWith('You are missing your unique clientId. Please correct and retry.');
  })

  it('should throw error when trying to create a document without authentication', async() => {
    const service:Document = app.service('document');
    return expect(service.create({
      visibility:'private',
      content: {aProp: 'A property'},
      key:'a doc'
    })).to.be.rejectedWith('You are missing your unique clientId. Please correct and retry.');
  })

  it('should throw error when trying to create a document with limited authentication', async() => {
    const service:Document = app.service('document');
    const standardUserParams = await getAuthenticationParams('standarduser','standard',port);
    return expect(service.create({
      visibility:'private',
      content: {aProp: 'A property'},
      key:'a doc'
    }, standardUserParams)).to.be.rejectedWith('Method create for service document is not authorized for user standarduser');
  })

  it('should create a document with extended authentication (non admin)', async() => {
    const service:Document = app.service('document');
    const elevatedParams = await getAuthenticationParams('otheruser','anotherpassword',port);
    return expect(await service.create({
      content: {
        aProp: "A property"
      },
      key: "a doc",
      visibility: "private"
    }, elevatedParams)).to.be.eql({
      content: {
        aProp: "A property"
      },
      documentType: "default",
      editorRoles: [],
      editors: [],
      id: 3,
      key: "a doc",
      ownerId: 1,
      readerRoles: [],
      readers: [],
      visibility: "private"
    })
  })

});
