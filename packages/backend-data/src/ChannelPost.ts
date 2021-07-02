import {Entity, EntityFields as EntityMeta} from "./Entity";
import {User} from "./User";
import {Field} from "./Metadata/Field";
import {InterfaceMeta} from "./Metadata/InterfaceMeta";

export interface ChannelPost extends Entity  {
  author?:number | Partial<User>,
  creationDate?: Date,
  channelKey?:string,
  parentPost?:number
  content:string,
  attachments?: string[]
  tags?:string[],

}

export const Meta:InterfaceMeta = {
  label:'Publications',
  name:'channel-post',
  fields: [
    ...EntityMeta,
    {
      name: 'author',
      label: 'Auteur',
      description: 'Auteur du post ou identifiant de l\'auteur du post',
      type: 'user',
      visible: true,
      editable: false
    },
    {
      name: 'creationDate',
      label: 'Date de création',
      description: 'Date de création',
      type: 'date',
      visible: true,
      editable: false
    },
    {
      name: 'channelKey',
      label: 'Clé du canal',
      description: 'Clé du canal du post',
      type: 'string',
      visible: true,
      editable: false
    },
    {
      name: 'parentPost',
      label: 'Post parent',
      description: 'Identifiant du post parent',
      type: 'number',
      visible: true,
      editable: false
    },
    {
      name: 'content',
      label: 'Contenu',
      description: 'Contenu du post',
      type: 'string',
      visible: true,
      editable: true
    },
    {
      name: 'attachments',
      label: 'Pièces jointes',
      description: 'Listes des clés uniques des média liés aux posts',
      type: 'array:string',
      visible: true,
      editable: true
    },
    {
      name: 'tags',
      label: 'Etiquettes',
      description: 'Etiquettes du post',
      type: 'array:string',
      visible: true,
      editable: true
    }
  ]
}