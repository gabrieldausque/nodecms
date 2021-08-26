import {Entity, EntityFields as EntityMeta} from "./Entity";
import {Field} from "./Metadata/Field";
import {InterfaceMeta} from "./Metadata/InterfaceMeta";

export interface Authorization extends Entity {
    id?: number
    on: string,
    onType: string,
    for?: string,
    right: string,
    role?: number
}

export const Meta:InterfaceMeta = {
  name:'authorization',
  label:'Autorisations',
  fields: [
      ...EntityMeta,
      {
          name:'on',
          label:'Catégorie',
          type:'string',
          visible:true,
          description: 'Opération ou Données',
          editable: true,
          masked:false
      },
      {
          name:'onType',
          label:'Sous Catégorie',
          type:'string',
          visible:true,
          description:'Type d\'opération REST ou type de donnée',
          editable: true,
          masked:false
      },
      {
          name:'for',
          label:'Entité',
          type:'string',
          visible:true,
          description:'Identifiant de service ou de donnée',
          editable: true,
          masked:false
      },
      {
          name:'right',
          label:'Droit',
          type:'string',
          visible:true,
          description:'Type de droit : x pour execution, r pour lecture, et w pour écriture',
          editable: true,
          masked:false
      },
      {
          name:'role',
          label:'Role',
          type:'number',
          visible:true,
          description:'Identifiant du role pour lequel ce droit s\'applique',
          editable: true,
          masked:false
      },
  ]
}