import {Entity, Meta as EntityMeta} from "./Entity";
import {Field} from "./Metadata/Field";

export interface Authentication extends Entity {
  login?:string,
  password?:string
  encryptedToken?:string
  clientUniqueId?:string
}

export const Meta:Field[] = [
  ...EntityMeta,
  {
    name:'login',
    label:'Login',
    type:'string',
    visible:true,
    description: 'Login',
    editable: false
  },
  {
    name:'encryptedToken',
    label:'Token',
    type:'string',
    visible:true,
    description: 'Token d\'authentification crypté',
    editable: false
  },
  {
    name:'clientUniqueId',
    label:'Identifiant Client',
    type:'string',
    visible:true,
    description: 'Identifiant du client',
    editable: false
  }
]
