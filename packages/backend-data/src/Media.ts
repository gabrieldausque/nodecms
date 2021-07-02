import {Entity, EntityFields} from "./Entity";
import {Buffer} from 'buffer'
import {InterfaceMeta} from "./Metadata/InterfaceMeta";

export const MediaVisibility = {
  public:"public",
  protected:"protected",
  private:"private"
}

export interface Media extends Entity {
  visibility: string,
  key: string,
  label: string,
  mediaType: string,
  storagePath: string,
  ownerId: string,
  readers:number[],
  blob?: Buffer
  tags: string[]
}

export const Meta:InterfaceMeta = {
  label:'Média',
  name:'media',
  fields: [
    ...EntityFields,
    {
      name: 'visibility',
      type: 'string',
      visible: true,
      editable: true,
      description: 'Visibilité du media',
      label: 'Visibilité'
    },
    {
      name: 'key',
      label: 'Clé',
      type: 'string',
      visible: true,
      editable: true,
      description: 'Clé unique du media'
    },
    {
      name: 'label',
      label: 'Label',
      type: 'string',
      visible: true,
      editable: true,
      description: 'Label du media'
    },
    {
      name: 'mediaType',
      type: 'string',
      visible: true,
      editable: true,
      description: 'Mime type du Média',
      label: 'MimeType'
    },
    {
      name: 'storagePath',
      label: 'Chemin',
      type: 'string',
      visible: true,
      editable: false,
      description: 'Chemin de stockage local du media'
    },
    {
      name:'ownerId',
      type:'user',
      visible: true,
      editable: false,
      description: 'Identifiant du propriétaire du media',
      label:'Propriétaire'
    },
    {
      name:'readers',
      type:'array:role',
      visible:true,
      editable: true,
      description:'Identifiants des roles lecteurs du media',
      label: 'Roles lecteurs'
    },
    {
      name:'blob',
      type:'object',
      visible:false,
      editable:false,
      label: 'Contenu',
      description: 'Contenu du media'
    },
    {
      name:'tags',
      type:'array:string',
      visible:true,
      editable: true,
      description: 'List des étiquettes associés au média',
      label:'Etiquettes'
    }
  ]
}