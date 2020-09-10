import {Authorization} from "../plugins/Storages/Authorization/AuthorizationStorage";
import {UseCases} from "./UseCases";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {AuthorizationEntityRules} from "../entities/AuthorizationEntityRules";
import {NotImplemented} from "@feathersjs/errors";

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
    super('AuthorizationStorage',configuration);
  }

  async create(entity: Authorization): Promise<Authorization> {
    AuthorizationEntityRules.convert(entity);
    return this.storage.create(entity);
  }

  async delete(id: string | number): Promise<Authorization> {
    throw new NotImplemented()
  }

  find(filter: Authorization): Authorization[] {
    throw new NotImplemented()
  }

  get(id: string | number): Authorization {
    throw new NotImplemented()
  }

  async update(id: string | number, entityToUpdate: Authorization): Promise<Authorization> {
    throw new NotImplemented()
  }

}
