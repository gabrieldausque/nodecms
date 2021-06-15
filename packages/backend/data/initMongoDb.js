var conn = new Mongo();
var adminDb = conn.getDB('admin');
adminDb.auth('root', 'Mbhj#ksf1445Mbfgqg');
var teamADb = conn.getDB('teama');
teamADb.dropDatabase();
teamADb.dropUser('admin_teama')
teamADb.createUser({
  user:'admin_teama',
  pwd:'jfkbqsgbEGQ#dd54qfdgb',
  roles:[
    {
      role:"readWrite",
      db:"teama"
    }
  ],
  passwordDigestor:"server"
})

function newId(collectionName){
  var result = teamADb.counters.findOneAndUpdate({
    name:collectionName
  }, {
    $inc: {lastId:1}
  }, {
    upsert:true
  })
  if(result && result.lastId){
    return result.lastId
  }
  return 0;
};

function initData(){
  // lnvgQFD#[3FQHfdFDGfd
  teamADb.users.insert({id:  newId('users'), login:"admin",password:"2e3603b7d8388c72017683d5302f1817:04a8fb0d44c1b8d0288710936549794ae0800b68:152862e37239b0bfd5557f889856336f",isActive:true});
  // Cigare
  teamADb.users.insert({id:  newId('users'), login:"Hannibal",password:"f80ce4edc3fa244cf3dc593a5c7eca22:b696c5977bc5:1aaf4b193809c393b62d78fdf55beda0",isActive:true});
  // Faceman
  teamADb.users.insert({id:  newId('users'), login:"Fute",password:"319b1027f58472157e005994978feaf9:91d613e6edd028:b0bdac5e0533024d0213f34d8cb4ea8b",isActive:true});
  // HowlingMad
  teamADb.users.insert({id:  newId('users'), login:"Looping",password:"0b00d7980c466e2f207e3132b6972404:194e6c3ca6e16e288202:d8ebc0a1deffc86c0e291d9c005ab05d",isActive:true});
  // BadAttitude
  teamADb.users.insert({id:  newId('users'), login:"Barracuda",password:"5e8cf6ce69de40d7b667d97662878bf4:3f5bb2a1c26c7491769681:6192d61a799c12cccd35aae2c25d359b",isActive:true});
  //TripleA
  teamADb.users.insert({id:  newId('users'), login:"Amanda",password:"f0fe507b8952faed1d75ba5a093d609e:6d409f10366620:e2793c9e785d065f28d70d2de3ab2d71",isActive:true});

  teamADb.roles.insert({id:  newId('roles'), key:"administrators", description:"Administrators group", members:[0,1], ownerId:0, creationDate: new Date()});
  teamADb.roles.insert({id:  newId('roles'), key:"specialUsers", description:"special Users group", members:[2], ownerId:0, creationDate: new Date()});
  teamADb.roles.insert({id:  newId('roles'), key:"users", description:"Users group", members:[3,4,5], ownerId:0, creationDate: new Date()});


  teamADb.metadata.insert({id:  newId('metadata'), key:"title",value:"The A Team",isPublic:true,ownerType:'',ownerId:null})
  teamADb.metadata.insert({id:  newId('metadata'), key:"logo",value:"https://frontend.myhost.domain/api/a-team_logo.png",isPublic:true,ownerType:'',ownerId:null})
  teamADb.metadata.insert({id:  newId('metadata'), key:"private-metadata",value:"my private value",isPublic:false,ownerType:'',ownerId:null})
  teamADb.metadata.insert({id:  newId('metadata'), key:"pseudonym",value:"MyPseudo",isPublic:false,ownerType:"user",ownerId:0})

  //rights for administrators
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"create",for:"*",right:"x",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"update",for:"*",right:"x",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"patch",for:"*",right:"x",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"remove",for:"*",right:"x",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"find",for:"*",right:"x",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"get",for:"*",right:"x",role:0})

  //rights for roles
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"create",for:"role",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"create",for:"role",right:"x",role:2})

  //rights for users
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"get",for:"user",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"get",for:"user",right:"x",role:2})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"find",for:"user",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"find",for:"user",right:"x",role:2})

  //rights for authorizations
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"create",for:"authorizations",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"create",for:"authorizations",right:"x",role:2})

  //rights for channel service
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"create",for:"channel",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"create",for:"channel",right:"x",role:2})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"remove",for:"channel",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"remove",for:"channel",right:"x",role:2})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"get",for:"channel",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"get",for:"channel",right:"x",role:2})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"find",for:"channel",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"find",for:"channel",right:"x",role:2})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"update",for:"channel",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"update",for:"channel",right:"x",role:2})

  //rights for channel post
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"create",for:"channel-posts",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"create",for:"channel-posts",right:"x",role:2})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"remove",for:"channel-posts",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"remove",for:"channel-posts",right:"x",role:2})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"get",for:"channel-posts",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"get",for:"channel-posts",right:"x",role:2})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"find",for:"channel-posts",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"find",for:"channel-posts",right:"x",role:2})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"update",for:"channel-posts",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"update",for:"channel-posts",right:"x",role:2})

  //rights for media
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"create",for:"media",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"create",for:"media",right:"x",role:2})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"get",for:"media",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"get",for:"media",right:"x",role:2})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"find",for:"media",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"find",for:"media",right:"x",role:2})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"delete",for:"media",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"delete",for:"media",right:"x",role:2})

  //rights for document
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"create",for:"document",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"get",for:"document",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"get",for:"document",right:"x",role:2})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"find",for:"document",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"find",for:"document",right:"x",role:2})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"update",for:"document",right:"x",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"delete",for:"media",right:"x",role:1})

  //rights for role data access (as operations are all authorized by default)
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"data",onType:"role",for:"*",right:"r",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"data",onType:"role",for:"*",right:"r",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"data",onType:"role",for:"*",right:"r",role:2})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"data",onType:"role",for:"*",right:"w",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"data",onType:"role",for:"*",right:"w",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"data",onType:"role",for:"*",right:"w",role:2})

  //rights for metadata access (as operations are all authorized by default)
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"data",onType:"metadata",for:"*",right:"r",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"data",onType:"metadata",for:"*",right:"w",role:0})

  //rights for user data access
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"data",onType:"user",for:"*",right:"r",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"data",onType:"user",for:"*",right:"r",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"data",onType:"user",for:"*",right:"r",role:2})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"data",onType:"user",for:"*",right:"w",role:0})

  //init media
  teamADb.media.insert({
    id: newId('media'),
    key: 'logo',
    visibility: 'public',
    label: 'team-a logo',
    mediaType: 'image/png',
    ownerId: 0,
    storagePath: 'uploads/a-team_logo.png',
    readers: [],
    tags: []
  })

  //init documents

  //media editor
  teamADb.documents.insert({
    id: newId('documents'),
    key: 'media',
    content: {
      headers:[ ],
      bodies:[
        {
          order:0,
          type:'all-media',
          properties:{}
        }
      ]
    },
    visibility: 'protected',
    ownerId: 0,
    creationDate: new Date(),
    updateDate: new Date()
  })

  // documents lists and editor
  teamADb.documents.insert({
    id: newId('documents'),
    key: 'documents',
    content: {
      headers:[ ],
      bodies:[
        {
          order:0,
          type:'documents',
          properties:{}
        }
      ]
    },
    visibility: 'protected',
    ownerId: 0,
    creationDate: new Date(),
    updateDate: new Date()
  })
  teamADb.documents.insert({
    id: newId('documents'),
    key: 'documentEditor',
    content: {
      headers:[ ],
      bodies:[
        {
          order:0,
          type:'documentEditor',
          properties:{}
        }
      ]
    },
    visibility: 'protected',
    ownerId: 0,
    creationDate: new Date(),
    updateDate: new Date()
  })

  // channels access
  teamADb.documents.insert({
    id: newId('documents'),
    key: 'channels',
    content: {
      bodies:[
        {
          order:0,
          type:'channels',
          properties:{
            channelKey:"news"
          }
        }
      ]
    },
    visibility: 'protected',
    ownerId: 0,
    creationDate: new Date(),
    updateDate: new Date()
  });

  // welcome pages
  teamADb.documents.insert({
    id: newId('documents'),
    key: 'welcomePrivate',
    content: {
      bodies:[
        {
          order:0,
          type:'channels',
          properties:{
            channelKey:"news"
          }
        }
      ]
    },
    visibility: 'protected',
    ownerId: 0,
    creationDate: new Date(),
    updateDate: new Date()
  });
  teamADb.documents.insert({
    id: newId('documents'),
    key: 'welcome',
    content: {
      globalStyle: 'h2 {    font-family: Army, serif;    margin-top: 90px;}\n.documentContainer {    display: flex;    flex-direction:column;    align-items: center;    justify-content: center;    height:100%;    width:100%}\n.main-logo {    height: initial !important;    width: initial !important;    display: flex;    align-items: center;    justify-content: center;}\n',
      style: '',
      classes: 'documentContainer',
      headers: [],
      bodies: [
        {
          order: 1,
          type: 'text',
          properties: {
            content: 'Servir sans faillir&nbsp;',
            style: 'font-family: Army; color: white; display: flex; align-items:end; justify-content: center; font-size: 35px; height: 50px;',
            classes: 'myH2Class',
            row: 2,
            col: 0
          }
        },
        {
          order: 0,
          type: 'media',
          globalStyle: '            @keyframes animatedBorderTop {                0% {                    left:-30px; height:3px; width:0px;                }                50% {                    left:-30px; height: 3px; width: calc(100% + 60px);                }                100% {                    left: calc(100% + 27px); height:3px; width:3px;                }            }\n            @keyframes animatedBorderRight {                0% {                    top:-30px; left: calc(100% + 27px); height:0px; width:3px;                }                50% {                    top:-30px;left: calc(100% + 27px); height: calc(100% + 57px); width: 3px;                }                100% {                    top: calc(100% + 30px); height: 0px; width:3px;                }            }\n            @keyframes animatedBorderBottom {                0% {                    right: -30px; width:0px;                }                50% {                    right: -30px; width: calc(100% + 60px);                }                100% {                    right: calc(100% + 30px); width:0px;                }            }\n            @keyframes animatedBorderLeft {                0% {                    bottom:-30px; width:3px; height:0px;                }                50% {                    bottom: -30px; height: calc(100% + 60px)                }                100% {                    bottom: calc(100% + 30px); height: 0px;                }            }\n            .main-logo-border-top {            position:absolute;            background: red;            top:-30px;            left:-30px;            height:3px;            width:0px;            animation: 10s linear infinite animatedBorderTop;            }\n            .main-logo-border-right {            position:absolute;            background: red;            top:-30px;            left: calc(100% + 27px);            height:0px;            width:3px;            animation: 10s linear 5s infinite animatedBorderRight;            }\n            .main-logo-border-bottom {            position:absolute;            background: red;            bottom: -30px;            right: -30px;            height:3px;            width:0px;            animation: 10s linear infinite animatedBorderBottom;            }\n            .main-logo-border-left {            position:absolute;            background: red;            bottom: -30px;            left: -30px;            height:0px;            width:3px;            animation: 10s linear 5s infinite animatedBorderLeft;            }            ',
          classes: 'main-logo',
          style: '',
          properties: {
            globalStyle: ' #image-logo { height: 100%; width: 100%; max-height: 100%; }\n@keyframes animatedBorderTop {\n\t0% {\n\t\tleft: calc(50% - 210px);\n\t\theight: 3px;\n\t\twidth: 0px;\n\t}\n\t50% {\n\t\tleft: calc(50% - 210px);\n\t\theight: 3px;\n\t\twidth: 420px;\n\t}\n\t100% {\n\t\tleft: calc(50% + 207px);\n\t\theight: 3px;\n\t\twidth: 3px;\n\t}\n}\n\n@keyframes animatedBorderRight {\n\t0% {\n\t\ttop: calc(50% - 210px);\n\t\tleft: calc(50% + 207px);\n\t\theight: 0px;\n\t\twidth: 3px;\n\t}\n\t50% {\n\t\ttop: calc(50% - 210px);\n\t\tleft: calc(50% + 207px);\n\t\theight: 420px;\n\t\twidth: 3px;\t}\n\t100% {                top: calc(50% + 210px);                left: calc(50% + 207px);                height: 0px;\n\t\twidth: 3px;\t}\n}\n\n@keyframes animatedBorderBottom {\n\t0% {                top: calc(50% + 207px);\n\t\tright: calc(50% - 207px);\n\t\twidth: 0px;\n\t}\n\t50% {                top: calc(50% + 207px);\n\t\tright: calc(50% - 207px);\n\t\twidth: 420px;\t}\n\t100% {                top: calc(50% + 207px);  \t\tright: calc(50% + 207px);\n\t\twidth: 0px;                left: calc(50% - 207px); \t}\n}\n\n@keyframes animatedBorderLeft {\n\t0% {\n\t\tbottom: calc(50% - 210px);\n\t\twidth: 3px;\n\t\theight: 0px;\n\t}\n\t50% {               bottom: calc(50% - 210px);\n\t\theight: 420px;\t}\n\t100% { \t\tbottom: calc(50% + 210px);                top:  calc(50% - 210px);\n\t\theight: 0px;\n\t}\n}\n\n.main-logo-border-top {\n\tposition: absolute;\n\tbackground: red;\n\ttop: calc(50% - 210px);\n\tleft: calc(50% - 210px);\n\theight: 3px;\n\twidth: 420px;        animation: 10s linear infinite animatedBorderTop;  \n}\n\n.main-logo-border-right {\n\tposition: absolute;\n\tbackground: red;\n\ttop: calc(50% - 210px);\n\tleft: calc(50% + 207px);\n\theight: 0px;\n\twidth: 3px;         animation: 10s linear 5s infinite animatedBorderRight;\n}\n\n.main-logo-border-bottom {\n\tposition: absolute;\n\tbackground: red;\n        top: calc(50% + 207px);\n\tright: calc(50% - 210px);\n\theight: 3px;\n\twidth: 0px;         animation: 10s linear 10s infinite animatedBorderBottom;       }\n\n.main-logo-border-left {\n\tposition: absolute;\n\tbackground: red;\n\tbottom: calc(50% - 210px);\n\tleft: calc(50% - 210px);\n\theight: 0px;\n\twidth: 3px;            animation: 10s linear 15s infinite animatedBorderLeft;     }',
            mediaType: 'image/png',
            key: 'logo',
            style: 'display:flex; height: 400px; align-items: center; justify-content:center;',
            content: '            <div class="main-logo-border-top"></div>            <div class="main-logo-border-right"></div>            <div class="main-logo-border-bottom"></div>            <div class="main-logo-border-left"></div>            ',
            row: 1,
            col: 0
          }
        },
        {
          order: 0,
          type: 'text',
          properties: {
            row: 0,
            col: 0
          }
        }
      ],
      footers: [],
      layout: {
        bodies: {
          type: 'grid'
        },
        headers: {
          type: 'grid'
        }
      }
    },
    visibility: 'public',
    ownerId: 0,
    creationDate: new Date(),
    updateDate: new Date()
  });

  teamADb.documents.insert({
    id: newId('documents'),
    key: 'tests',
    content: {
      layout: {
        bodies:{
          type:"grid"
        }
      },
      bodies:[
        {
          order:0,
          type:'text',
          properties:{
            col:1,
            row:1,
            content:"Texte for the test"
          }
        },
        {
          order:0,
          type:'text',
          properties:{
            col:0,
            row:0,
            content:"Second text"
          }
        }
      ]
    },
    visibility: 'protected',
    ownerId: 0,
    creationDate: new Date(),
    updateDate: new Date()
  });

  // channels creation
  teamADb.channels.insert({id:  newId('channels'),key:'news', label:'Actualités', visibility:'protected', administrators:[0], editors:[],contributors:[1], readers:[2]});
  teamADb['channel#news'].insert({id:  newId('channel#news'), channelKey:'news',
    content:`<h1> Bienvenue Sur le Channel news</h1>
<div>Bienvenu sur le fil public des news du site communataire de l'Agence tous risques !</div>`,
    tags:['Welcome'], author:0, creationDate: new Date()});
};

initData()
