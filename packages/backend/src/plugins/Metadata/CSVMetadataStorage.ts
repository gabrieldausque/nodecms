import {Metadata, MetadataStorage} from "../interfaces/MetadataStorage";
const dataLoader = require('csv-load-sync');

export class CSVMetadataStorage implements MetadataStorage {
  public static metadata:any[] = [
    {
      contractType:'MetadataStorage',
      contractName:'CSV',
      isShared:true
    },
    {
      contractType:'MetadataStorage',
      contractName:'Default',
      isShared:true
    },
  ]
  database: Metadata[];

  constructor(filePath:string = 'data/metadata.csv') {
    if(!filePath){
      filePath = 'data/metadata.csv';
    }
    const fromFile = dataLoader(filePath)
    this.database = fromFile.map((m:any) => {
      return {
        key: m.key,
        value: m.value,
        isPublic: (m.isPublic.toLowerCase() === 'true')
      }
    });
  }

  get(key:string):Metadata|null {
    const metadata = this.database.find(m  => m.key === key);
    if(metadata)
      return metadata;
    return null;
  }
}
