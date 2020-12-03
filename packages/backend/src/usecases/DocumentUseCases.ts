import {UseCases} from "./UseCases";
import {Document} from "../entities/Document";
import {User} from "../entities/User";

export class DocumentUseCases extends UseCases<Document> {

  public static metadata:any[] = [
    {
      contractType:'UseCases',
      contractName:'Document',
      isShared:true
    }
  ]


  async create(entity: Document, executingUser: User): Promise<Document> {
    throw new Error('Not implemented');
  }

  async delete(id: string | number, executingUser: User): Promise<Document> {
    throw new Error('Not implemented');
  }

  async find(filter: Partial<Document>, executingUser: User | undefined): Promise<Document[]> {
    throw new Error('Not implemented');
  }

  async get(id: string | number, executingUser: User | undefined): Promise<Document> {
    throw new Error('Not implemented');
  }

  async update(id: string | number, entityToUpdate: Document, executingUser: User): Promise<Document> {
    throw new Error('Not implemented');
  }

}
