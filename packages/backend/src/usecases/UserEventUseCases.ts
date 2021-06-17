import {UseCases} from "./UseCases";
import {UserEvent} from "@nodecms/backend-data";
import {UserEventEntityRules} from "@nodecms/backend-data-rules/dist/UserEventEntityRules";
import {UseCaseConfiguration} from "./UseCaseConfiguration";

interface UserEventUseCasesConfiguration extends UseCaseConfiguration {};

export class UserEventUseCases extends UseCases<UserEvent, UserEventEntityRules> {

  public static metadata:any[] = [
    {
      contractType:'UseCases',
      contractName:'UserEvent',
      isShared:true
    }
  ]

  constructor(configuration:UserEventUseCasesConfiguration) {
    super('userEvent',
      'UserEventStorage',
      configuration,
      false,
      UserEventEntityRules);
  }
}
