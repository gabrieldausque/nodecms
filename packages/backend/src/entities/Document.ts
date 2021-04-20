import {Entity} from "./Entity";

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
    footers?:[]
    [prop:string] : any
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
