import * as assert from 'assert';
import app from '../../src/app';
import {expect, getAuthenticationParams, getUrl, initMongoDbTestDatabase} from '../../src/tests/TestsHelpers'
import {Server} from "http";
import axios from "axios";
import {globalInstancesFactory} from "@hermes/composition";
import {Document} from "../../src/services/document/document.class"
import {Document as DocumentEntity} from "../../src/entities/Document"
import {v4 as uuid} from "uuid";
const port = app.get('port') || 3030;

describe('Document service', () => {

  let server: Server;
  let finalCookie = '';
  let params:any = {};
  let clientUniqueId = uuid();

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
    params.query = {}
  })

  after(async()=> {
    server.close();
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
    let gotten:Partial<DocumentEntity>[] = await service.find(params) as Partial<DocumentEntity>[];
    if(Array.isArray(gotten) && gotten[0])
    {
      delete gotten[0].isReader;
      delete gotten[0].isEditor;
    }
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
    let gotten:Partial<DocumentEntity>[] = await service.find(params) as Partial<DocumentEntity>[];
    if(Array.isArray(gotten) && gotten[0])
    {
      delete gotten[0].isReader;
      delete gotten[0].isEditor;
    }
    expect(created).to.be.eql(gotten[0])
    if(typeof created.id === 'number'){
      const deleted = await service.remove(created.id, params)
      expect(created).to.be.eql(deleted)
      gotten = await service.find(params) as Partial<DocumentEntity>[];
      expect(gotten.length).to.be.eql(0);
    }else {
      assert.fail('No id in created');
    }

  })

  it('should get public document without authentication', async() => {
    const service:Document = app.service('document');
    const publicDoc = await service.get(0);
    delete publicDoc.creationDate;
    delete publicDoc.updateDate;
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
    const standardUserParam = await getAuthenticationParams('standarduser', 'standard', port, clientUniqueId);
    const protectedDoc = await service.get(1, standardUserParam);
    delete protectedDoc.creationDate;
    delete protectedDoc.updateDate;
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
    const standardUserParam = await getAuthenticationParams('standarduser', 'standard', port, clientUniqueId);
    const protectedDocPromise = service.get(2, standardUserParam);
    return expect(protectedDocPromise).to.be.rejectedWith('User standarduser is not authorized to access document with id 2');
  })

  it('should get private document with authorized non admin authentication', async() => {
    const service:Document = app.service('document');
    const otherUserParams = await getAuthenticationParams('otheruser', 'anotherpassword', port, clientUniqueId);
    const protectedDoc = await service.get(2, otherUserParams);
    delete protectedDoc.creationDate;
    delete protectedDoc.updateDate;
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
    delete protectedDoc.updateDate;
    delete protectedDoc.creationDate;
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
    for(const doc of protectedDocs){
      delete doc.updateDate;
      delete doc.creationDate;
    }
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
        key: 'welcome',
        isReader: true,
        isEditor: false
      })
    ])
  })

  it('should find all authorized documents with limited authentication', async() => {
    const service:Document = app.service('document');
    const standardUserParam = await getAuthenticationParams('standarduser', 'standard', port, clientUniqueId);
    standardUserParam.query = {
      ownerId:0
    };
    const protectedDocs:any = await service.find(standardUserParam);
    for(const doc of protectedDocs){
      delete doc.updateDate;
      delete doc.creationDate;
    }
    return Promise.all([
      expect(protectedDocs.length).to.be.eql(2),
      expect(protectedDocs).to.be.eql([{
        id:1,
        ownerId:0,
        readers: [],
        documentType: 'default',
        readerRoles: [],
        editors: [],
        editorRoles: [1],
        visibility: 'protected',
        content: { prop: 'MyContentPropProtected'},
        key: 'welcomeProtected',
        isReader:true,
        isEditor: false
      }, {
        id:0,
        ownerId:0,
        readers: [],
        documentType: 'default',
        readerRoles: [],
        editors: [],
        editorRoles: [],
        visibility: 'public',
        content: { prop: 'MyContentProp'},
        key: 'welcome',
        isReader: true,
        isEditor:false
      }])
    ])
  })

  it('should find all authorized documents with extended authentication', async() => {
    const service:Document = app.service('document');
    const specialUserParam = await getAuthenticationParams('otheruser', 'anotherpassword', port, clientUniqueId);
    specialUserParam.query = {
      ownerId:0
    };
    const protectedDocs:any = await service.find(specialUserParam);
    for(const doc of protectedDocs){
      delete doc.updateDate;
      delete doc.creationDate;
    }
    return Promise.all([
      expect(protectedDocs.length).to.be.eql(3),
      expect(protectedDocs).to.be.eql([{
        id:2,
        ownerId:0,
        readers: [],
        documentType: 'default',
        readerRoles: [1],
        editors: [],
        editorRoles: [0],
        visibility: 'private',
        content: { prop: 'MyContentPropPrivate'},
        key: 'welcomePrivate',
        isReader: true,
        isEditor: false
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
        key: 'welcomeProtected',
        isReader: true,
        isEditor:true
      },{
        id:0,
        ownerId:0,
        readers: [],
        documentType: 'default',
        readerRoles: [],
        editors: [],
        editorRoles: [],
        visibility: 'public',
        content: { prop: 'MyContentProp'},
        key: 'welcome',
        isReader:true,
        isEditor:false
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
    const standardUserParams = await getAuthenticationParams('standarduser','standard',port, clientUniqueId);
    return expect(service.create({
      visibility:'private',
      content: {aProp: 'A property'},
      key:'a doc'
    }, standardUserParams)).to.be.rejectedWith('Method create for service document is not authorized for user standarduser');
  })

  it('should create a document with extended authentication (non admin)', async() => {
    const service:Document = app.service('document');
    const elevatedParams = await getAuthenticationParams('otheruser','anotherpassword',port, clientUniqueId);
    const createdDoc = await service.create({
      content: {
        aProp: "A property"
      },
      key: "a doc",
      visibility: "private"
    }, elevatedParams);
    delete createdDoc.creationDate;
    delete createdDoc.updateDate;
    return expect(createdDoc).to.be.eql({
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

  it("should return 10 first documents on first call and then the rest of it", async() => {
    const service:Document = app.service('document');
    for(let i = 0; i < 13; i++){
      await service.create({
        key: `document-${i}`,
        content: {
          bodies:[
            {
              order:0,
              type: 'text',
              properties:{
                content:`<p>document-${i}</p>`
              }
            }
          ]
        }
      }, params)
    }
    const documents:any = await service.find(params);
    expect(documents.length).to.eql(10);
    const newParams = {
      ...params,
      ...{
        query: {
          lastIndex: documents[documents.length - 1].id
        }
      }
    };
    const nextDocuments:any = await service.find(newParams)
    expect(nextDocuments.length).to.eql(6);
  })

});
