import {Entity, EntityFields as EntityMeta} from "./Entity";
import {Field} from "./Metadata/Field";
import {InterfaceMeta} from "./Metadata/InterfaceMeta";

export const DocumentVisibility = {
  public:"public",
  protected:"protected",
  private:"private"
}

export interface DocumentComponent {
  order:number,
  type: string,
  properties: {
    [prop:string] : any
  }
}

export interface Document extends Entity {
  key:string,
  content: {
    globalStyle?: string,
    style?: string,
    classes?: string
    headers?:DocumentComponent[]
    bodies?:DocumentComponent[]
    footers?:DocumentComponent[]
  },
  visibility:string,
  ownerId:number,
  documentType?:string,
  editorRoles:number[]
  editors:number[]
  readerRoles:number[],
  readers:number[],
  creationDate:Date,
  updateDate:Date
}

export const Meta:InterfaceMeta = {
  label:'Documents',
  name:'document',
  fields: [
    ...EntityMeta,
    {
      name: 'key',
      type: 'string',
      visible: true,
      editable: true,
      description: 'Clé unique du document',
      label: 'Clé'
    },
    {
      name: 'content',
      type: 'object',
      visible: false,
      editable: false,
      description: 'Contenu et structure du document',
      label: 'Contenu'
    },
    {
      name:'visibility',
      type:'string',
      visible: true,
      editable: true,
      label: 'Visibilité',
      description: 'Visibilité du document'
    },
    {
      name:'ownerId',
      label:'Propriétaire',
      description:'Identifiant du créateur/propriétaire du document',
      visible: true,
      editable: false,
      type:'user'
    },
    {
      name:'documentType',
      visible: true,
      editable: true,
      description:'Type du document',
      type: 'string',
      label: 'Type'
    },
    {
      name:'editorRoles',
      type:'array:role',
      label: 'Roles d\'édition',
      description: 'Roles pouvant éditer le document',
      visible: true,
      editable: true
    },
    {
      name:'editor',
      type:'array:user',
      label: 'Editeurs',
      description: 'Identifiants des utilisateurs pouvant éditer le document',
      visible: true,
      editable: true
    },
    {
      name:'readerRoles',
      type:'array:role',
      label: 'Roles lecteurs',
      description: 'Roles pouvant lire le document',
      visible: true,
      editable: true
    },
    {
      name:'readers',
      type:'array:user',
      label: 'Lecteurs',
      description: 'Identifiants des utilisateurs pouvant lire le document',
      visible: true,
      editable: true
    },
    {
      name:'creationDate',
      type:'date',
      label: 'Date de création',
      description: 'Date de création du document',
      visible: true,
      editable: true
    },
    {
      name:'updateDate',
      type:'date',
      label: 'Date de Mise à jour',
      description: 'Date de mise à jour du document',
      visible: true,
      editable: true
    }
  ]
}