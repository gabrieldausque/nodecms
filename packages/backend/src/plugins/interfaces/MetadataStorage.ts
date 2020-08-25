export interface Metadata {
  key:string;
  value:any;
  isPublic:boolean;
}

export interface MetadataStorage {
  get(key:string):Metadata|null;
}
