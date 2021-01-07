import {Entity} from "./Entity";

export const DocumentVisibility = {
  public:"public",
  protected:"protected",
  private:"private"
}

export interface Document extends Entity {
  content: { [prop:string] : any },
  documentType?:string,
  visibility:string,
  ownerId:number,
  editorRoles?:number[]
  editors?:number[]
  readerRoles?:number[],
  readers:number[]
}
