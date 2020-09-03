export interface Metadata {
  id?:number;
  key:string;
  value?:any;
  isPublic?:boolean;
  ownerType?:string | null;
  ownerId?:number | null;
}

export interface MetadataStorage {
  exists(keyOrId:string | number, ownerType?:string | null, ownerId?:number | null):boolean;

  get(keyOrId:string | number, ownerType?:string | null, ownerId?:number | null):Metadata;

  find(filter? : Metadata): Metadata[]

  create(data: Metadata): Promise<Metadata>;

  update(data: Metadata): Promise<Metadata>;

  delete(keyOrId:string | number, ownerType?:string | null, ownerId?:number | null):Promise<Metadata>;
}
