import {MongoDbStorage, MongoDbStorageConfiguration} from "../MongoDbStorage";
import {Document} from "../../../entities/Document";
import {DocumentStorage} from "./DocumentStorage";
import {isNumber} from "../../../helpers";
import {Channel} from "../../../entities/Channel";

export class MongoDbDocumentStorage extends MongoDbStorage<Document> implements DocumentStorage {

  public static metadata:any[] = [
    {
      contractType:'DocumentStorage',
      contractName:'MongoDb',
      isShared:true
    }
  ]

  async create(data: Document): Promise<Document> {
    if(!await this.exists(data.key)){
      const newDocument = {
        ...data,
        ...{
          id: await this.getNewId()
        }
      }
      await this.internalCreate(newDocument);
    }
    return await this.get(data.key);
  }

  async delete(keyOrIdOrDocument: string | number | Document): Promise<Document> {
    if(await this.exists(keyOrIdOrDocument)) {
      let usableId:number | null = null;
      if(isNumber(keyOrIdOrDocument)){
        usableId = parseInt(keyOrIdOrDocument.toString());
      } else if (typeof keyOrIdOrDocument === 'string'){
        const toDelete:Document = await this.get(keyOrIdOrDocument);
        usableId = toDelete.id as number;
      } else {
        const toDelete:Document = keyOrIdOrDocument as Document;
        usableId = toDelete.id as number;
      }
      if(usableId !== null){
        const deleted = await this.get(usableId);
        await this.internalDelete(deleted);
        return deleted;
      }
    }
    throw new Error(`No Document with key or id ${keyOrIdOrDocument}`)
  }

  async exists(keyOrIdOrDocument: string | number | Document): Promise<boolean> {
    let documents:Document[] = []
    if(isNumber(keyOrIdOrDocument)){
      documents = await this.find({
        id:parseInt(keyOrIdOrDocument.toString())
      })
    } else {
      documents = await this.find( {
        key:keyOrIdOrDocument.toString()
      })
    }
    return Array.isArray(documents) && documents.length > 0;
  }

  async find(filter: Partial<Document> | undefined, lastIndex?:number): Promise<Document[]> {
    if(filter){
      return await this.internalFind(filter, lastIndex, this.collectionName);
    }
    return await this.internalFind({});
  }

  async get(keyOrId: string | number): Promise<Document> {
    let document:Document | null = null;
    if(isNumber(keyOrId)){
      document = await this.internalGet(parseInt(keyOrId.toString()));
    } else {
      const found = await this.find({
        key:keyOrId.toString()
      });
      if(Array.isArray(found) && found.length > 0){
        document = found[0];
      }
    }
    if(document)
      return document;
    throw new Error(`Document with key or id ${keyOrId} doesn't exists`);
  }

  async update(data: Partial<Document>): Promise<Document> {
    await this.internalUpdate(data);
    return await this.get(data.id as number);
  }

  validateConfiguration(configuration: MongoDbStorageConfiguration) {
    configuration.pageSize = (typeof configuration.pageSize === 'number')?
      configuration.pageSize:
      10;
  }

}
