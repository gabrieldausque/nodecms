import {UseCases} from "./UseCases";
import {UserEvent} from "@nodecms/backend-data";

export class UserEventUseCases extends UseCases<UserEvent> {

  public static metadata:any[] = [
    {
      contractType:'UseCases',
      contractName:'UserEvent',
      isShared:true
    }
  ]

}
