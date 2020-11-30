import {Entity} from "./Entity";

export const ChannelVisibility = {
  public:"public",
  protected:"protected",
  private:"private"
}

export interface Channel extends Entity {
  key:string,
  visibility:string,
  label:string,
  readers:number[],
  contributors:number[],
  editors:number[]
  administrators:number[]
}
