import AuthenticationPlugin from '../../interfaces/AuthenticationPlugin';

export default class LocalAuthentication implements AuthenticationPlugin{
  public static metadata : any[] = [
    {
      contractType:'AuthenticationPlugin',
      contractName:'Default',
      isShared:true
    }
  ]

  async authenticate(login: string, password: string): Promise<void> {
    //TODO :
    return Promise.resolve(undefined);
  }

  isAuthenticated(): boolean {
    return false;
  }

}
