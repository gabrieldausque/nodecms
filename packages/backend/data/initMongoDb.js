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
  teamADb.roles.insert({id:  newId('roles'), key:"administrators", description:"Administrators group"});
  teamADb.roles.insert({id:  newId('roles'), key:"users", description:"Users group"});
  teamADb.roles.insert({id:  newId('roles'), key:"specialUsers", description:"special Users group"});

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

  teamADb.metadata.insert({id:  newId('metadata'), key:"title",value:"The A Team",isPublic:true,ownerType:'',ownerId:null})
  teamADb.metadata.insert({id:  newId('metadata'), key:"logo",value:"http://localhost:3030/a-team_logo.png",isPublic:true,ownerType:'',ownerId:null})
  teamADb.metadata.insert({id:  newId('metadata'), key:"private-metadata",value:"my private value",isPublic:false,ownerType:'',ownerId:null})
  teamADb.metadata.insert({id:  newId('metadata'), key:"pseudonym",value:"MyPseudo",isPublic:false,ownerType:"user",ownerId:0})
  teamADb.metadata.insert({id:  newId('metadata'), key:"roles",value:[0,1],isPublic:false,ownerType:"user",ownerId:0})
  teamADb.metadata.insert({id:  newId('metadata'), key:"roles",value:[1],isPublic:false,ownerType:"user",ownerId:1})
  teamADb.metadata.insert({id:  newId('metadata'), key:"roles",value:[1],isPublic:false,ownerType:"user",ownerId:2})
  teamADb.metadata.insert({id:  newId('metadata'), key:"roles",value:[1],isPublic:false,ownerType:"user",ownerId:3})
  teamADb.metadata.insert({id:  newId('metadata'), key:"roles",value:[1],isPublic:false,ownerType:"user",ownerId:4})
  teamADb.metadata.insert({id:  newId('metadata'), key:"roles",value:[1],isPublic:false,ownerType:"user",ownerId:5})

  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"create",for:"*",right:"x",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"update",for:"*",right:"x",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"update",for:"*",right:"x",role:2})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"patch",for:"*",right:"x",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"patch",for:"*",right:"x",role:2})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"remove",for:"*",right:"x",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"find",for:"*",right:"x",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"get",for:"*",right:"x",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"operation",onType:"remove",for:"user",right:"x",role:2})
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
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"data",onType:"role",for:"*",right:"r",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"data",onType:"role",for:"*",right:"r",role:1})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"data",onType:"role",for:"*",right:"w",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"data",onType:"metadata",for:"*",right:"r",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"data",onType:"metadata",for:"*",right:"w",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"data",onType:"user",for:"*",right:"r",role:0})
  teamADb.authorizations.insert({id:  newId('authorizations'), on:"data",onType:"user",for:"*",right:"w",role:0})

  teamADb.channels.insert({id:  newId('channels'),key:'news', label:'Actualités', visibility:'public'});
  teamADb.channels.insert({id:  newId('channel#news'), channelKey:'news',
    content:`<h1> Bienvenue Sur le Channel news</h1><br>
<div>Bienvenu sur le fil public des news du site communataire de l'Agence tous risques !</div>`,
    tags:['Welcome']});
};

initData()
