import {UseCases} from "./UseCases";
import {Authentication} from "../entities/Authentication";
import {User} from "../entities/User";

export class AuthenticationUseCases extends UseCases<Authentication> {

  public static metadata:any[] = [
    {
      contractType:'UseCases',
      contractName:'Authentication',
      isShared:true
    }
  ]

  async create(entity: Authentication, executingUser: User): Promise<Authentication> {
    throw new Error('Not Implemented')
  }

  async delete(id: string | number, executingUser: User): Promise<Authentication> {
    throw new Error('Not Implemented')
  }

  async find(filter: Partial<Authentication>, executingUser: User | undefined): Promise<Authentication[]> {
    throw new Error('Not Implemented')
  }

  async get(id: string | number, executingUser: User | undefined): Promise<Authentication> {
    throw new Error('Not Implemented')
  }

  async update(id: string | number, entityToUpdate: Authentication, executingUser: User): Promise<Authentication> {
    throw new Error('Not Implemented')
  }

}
