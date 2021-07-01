import {UseCases} from "./UseCases";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {AuthorizationEntityRules} from "@nodecms/backend-data-rules";
import {Authorization} from "@nodecms/backend-data";
import {User} from "@nodecms/backend-data";

interface AuthorizationUseCasesConfiguration extends UseCaseConfiguration {
}

export class AuthorizationUseCases extends UseCases<Authorization,
  AuthorizationEntityRules> {

  public static metadata:any[] = [
    {
      contractType:'UseCases',
      contractName:'Authorization',
      isShared:true
    }
  ]

  constructor(configuration:AuthorizationUseCasesConfiguration = {
    storage: {
      contractName:'Default'
    }
  }) {
    super('authorization',
      'AuthorizationStorage',
      configuration,
      false,
      AuthorizationEntityRules);
  }

  async create(entity: Partial<Authorization>, executingUser:User): Promise<Authorization> {
    this.entityRules.convert(entity);
    return this.storage.create(entity);
  }

  async delete(id: string | number, executingUser:User): Promise<Authorization> {
    //TODO : check in use case some condition
    const authorization = this.get(id, executingUser)
    await this.storage.delete(id);
    return authorization;
  }

  async find(filter: Authorization, lastIndex?:string | number, executingUser?:User): Promise<Authorization[]> {
    this.entityRules.convert(filter);
    let firstIndex : number | undefined = undefined
    if(typeof lastIndex != 'undefined' && lastIndex !== null)
      firstIndex = (await this.get(lastIndex, executingUser)).id
    return await this.storage.find(filter, firstIndex);
  }

  async get(id: string | number, executingUser?:User): Promise<Authorization> {
    const usableId = this.entityRules.convertId(id);
    return await this.storage.get(usableId);
  }

  async update(id: string | number, entityToUpdate: Authorization, executingUser?:User): Promise<Authorization> {
    throw new Error('Not allowed');
  }

}
