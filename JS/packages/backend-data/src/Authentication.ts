import {Entity, EntityFields as EntityMeta} from "./Entity";
import {Field} from "./Metadata/Field";
import {InterfaceMeta} from "./Metadata/InterfaceMeta";

export interface Authentication extends Entity {
  login?:string,
  password?:string
  encryptedToken?:string
  clientUniqueId?:string
}

export const Meta:InterfaceMeta ={
  label: 'Authentifications',
  name: 'authentication',
  fields:[
    ...EntityMeta,
    {
      name:'login',
      label:'Login',
      type:'string',
      visible:true,
      description: 'Login',
      editable: false,
      masked:false
    },
    {
      name:'encryptedToken',
      label:'Token',
      type:'string',
      visible:true,
      description: 'Token d\'authentification crypté',
      editable: false,
      masked:false
    },
    {
      name:'clientUniqueId',
      label:'Identifiant Client',
      type:'string',
      visible:true,
      description: 'Identifiant du client',
      editable: false,
      masked:false
    }
  ]
}