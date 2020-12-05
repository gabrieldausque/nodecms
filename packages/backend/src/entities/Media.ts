import {Entity} from "./Entity";

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
  storagePath: string
}
