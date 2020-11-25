import {UseCases} from "./UseCases";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {AuthorizationEntityRules} from "../entities/AuthorizationEntityRules";
import {Authorization} from "../entities/Authorization";

interface AuthorizationUseCasesConfiguration extends UseCaseConfiguration {
}

export class AuthorizationUseCases extends UseCases<Authorization> {

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
    super('authorization','AuthorizationStorage',configuration);
  }

  async create(entity: Authorization): Promise<Authorization> {
    AuthorizationEntityRules.convert(entity);
    return this.storage.create(entity);
  }

  async delete(id: string | number): Promise<Authorization> {
    const authorization = this.get(id)
    await this.storage.delete(id);
    return authorization;
  }

  async find(filter: Authorization): Promise<Authorization[]> {
    AuthorizationEntityRules.convert(filter);
    return await this.storage.find(filter);
  }

  async get(id: string | number): Promise<Authorization> {
    const usableId = AuthorizationEntityRules.convertId(id);
    return await this.storage.get(usableId);
  }

  async update(id: string | number, entityToUpdate: Authorization): Promise<Authorization> {
    throw new Error('Not allowed');
  }

}
