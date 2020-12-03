import {Entity} from "./Entity";

export interface Document extends Entity {
  content:string,
  visibility:string,
  ownerId:number,
  editorRoles?:number[]
  editors?:number[]
  readerRoles?:number[],
  readers:number[]
}
