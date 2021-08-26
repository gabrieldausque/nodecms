import {Field} from "./Metadata/Field";

export interface Entity {
  id?: number,
  isReader?: boolean,
  isEditor?: boolean,
  [key: string]: any
}

export const EntityFields:Field[] = [
  {
    name:'id',
    label:'Id',
    type:'number',
    visible:true,
    description: 'Identifiant unique',
    editable:false,
    masked:false
  },
  {
    name:'isReader',
    label:'Lecteur',
    type:'boolean',
    visible:false,
    description: 'Indique si l\'utilisateur courant est lecteur de la donnée',
    editable: false,
    masked:false
  },
  {
    name:'isEditor',
    label:'Editeur',
    type:'boolean',
    visible:false,
    description: 'Indique si l\'utilisateur courant est Editeur de la donnée',
    editable:false,
    masked:false
  }
]