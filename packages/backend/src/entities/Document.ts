import {Entity} from "./Entity";

export const DocumentVisibility = {
  public:"public",
  protected:"protected",
  private:"private"
}

export interface Document extends Entity {
  key:string,
  content: { [prop:string] : any },
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
