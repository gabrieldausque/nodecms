import {Entity} from "./Entity";
import {Buffer} from 'buffer'

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
}
