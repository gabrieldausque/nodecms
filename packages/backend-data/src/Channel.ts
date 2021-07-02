import {Entity, EntityFields as EntityMeta} from "./Entity";
import {Field} from "./Metadata/Field";
import {InterfaceMeta} from "./Metadata/InterfaceMeta";

export const ChannelVisibility = {
  public:"public",
  protected:"protected",
  private:"private"
}

export interface Channel extends Entity {
  key:string,
  visibility:string,
  label:string,
  readers?:number[],
  contributors?:number[],
  editors?:number[]
  administrators?:number[]
}

export const Meta:InterfaceMeta = {
  label: 'Canaux',
  name:'channel',
  fields: [
    ...EntityMeta,
    {
      name:'key',
      label:'Clé',
      type:'string',
      visible:true,
      editable:true,
      description:'Clé unique du Canal'
    },
    {
      name:'visibility',
      label:'Visibilité',
      type:'string',
      visible:true,
      editable:true,
      description:'Visibilité du canal'
    },
    {
      name:'label',
      label:'Label',
      type:'string',
      visible:true,
      editable:true,
      description:'Label du Canal'
    },
    {
      name:'readers',
      label:'Lecteurs',
      type:'array:role',
      visible:true,
      editable:true,
      description:'Liste des identifiants de roles lecteurs du canal'
    },
    {
      name:'contributors',
      label:'Contributeurs',
      type:'array:role',
      visible:true,
      editable:true,
      description:'Liste des identifiants de roles contributeurs du canal'
    },
    {
      name:'editors',
      label:'Editeurs',
      type:'array:role',
      visible:true,
      editable:true,
      description:'Liste des identifiants de roles Editeurs du canal'
    },
    {
      name:'administrators',
      label:'Administrateurs',
      type:'array:role',
      visible:true,
      editable:true,
      description:'Liste des identifiants de roles Administrateurs du canal'
    }
  ]
}