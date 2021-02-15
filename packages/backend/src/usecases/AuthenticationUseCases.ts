import {UseCases} from "./UseCases";
import {Authentication} from "../entities/Authentication";
import {User} from "../entities/User";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {globalInstancesFactory} from '@hermes/composition';
import {EncryptionPlugin} from "../plugins/Encryption/EncryptionPlugin";
import AuthenticationPlugin, {CustomAuthenticatedUserToken} from "../plugins/Authentication/AuthenticationPlugin";
import {AuthenticationEntityRules} from "../entities/AuthenticationEntityRules";
import {InvalidAuthenticationError} from "../entities/Errors/InvalidAuthenticationError";
import {UserUseCases} from "./UserUseCases";
import os from "os";

interface AuthenticationUseCasesConfiguration extends UseCaseConfiguration {
  encryption: {
    contractName:string,
    configuration: any
  },
  authentication: {
    contractName:string,
    configuration:any
  }
  authorityKey?:string,
  tokenTTLInSecond?:number
}

export class AuthenticationUseCases extends UseCases<Authentication> {

  public static metadata:any[] = [
    {
      contractType:'UseCases',
      contractName:'Authentication',
      isShared:true
    }
  ]

  private encryptor: EncryptionPlugin;

  private authenticator: AuthenticationPlugin;

  private authorityKey: string;

  private tokenTTL: number;

  constructor(configuration:AuthenticationUseCasesConfiguration) {
    super('authentication', 'Authentication', configuration);
    this.authorityKey = os.hostname();
    this.tokenTTL = 86400;
    this.encryptor = globalInstancesFactory.getInstanceFromCatalogs('EncryptionPlugin', configuration.encryption.contractName, configuration.encryption.configuration);
    this.authenticator = globalInstancesFactory.getInstanceFromCatalogs('AuthenticationPlugin', configuration.authentication.contractName, configuration.authentication.configuration);
    if(configuration) {
      if (configuration.authorityKey) {
        this.authorityKey = configuration.authorityKey
      } else {
        console.warn(`Beware : no authority key provided, default will be used, and it is not secure.` )
        this.authorityKey = os.hostname()
      }

      if(configuration.tokenTTLInSecond) {
        this.tokenTTL = configuration.tokenTTLInSecond;
      } else {
        console.warn('Default token TTL used.')
        this.tokenTTL = 86400;
      }
    }
  }

  async create(entity: Authentication, executingUser?: User): Promise<Authentication> {
    AuthenticationEntityRules.validateForAuthentication(entity)

    if(entity.login && entity.password && entity.clientUniqueId) {

      //TODO : create authorizedClientId if needed and authorize, or add new clientId to unknownClientIds metadata and wait for user to authorize new client id;
      // unknown client ids are rejected

      if(!await this.canAuthenticate(entity.login, entity.clientUniqueId, executingUser)) {
        throw new InvalidAuthenticationError(`User ${entity.login} can't authenticate for now, please retry later`);
      }
      const tokenDecrypted:CustomAuthenticatedUserToken = await this.authenticator.authenticate(entity.login, entity.password);
      tokenDecrypted.clientUniqueId = entity.clientUniqueId;
      tokenDecrypted.authorityKey = this.authorityKey;
      entity.encryptedToken = await this.encryptor.encryptCustomToken(tokenDecrypted);
    }

    return entity;
  }

  async delete(id: string | number, executingUser?: User): Promise<Authentication> {
    throw new Error('Not Implemented')
  }

  async find(filter: Partial<Authentication>, executingUser?:User): Promise<Authentication[]> {
    throw new Error('Not Implemented')
  }

  async get(id: string | number, executingUser?: User, encryptedToken?:string, clientUniqueId?:string): Promise<Authentication> {

    AuthenticationEntityRules.validate({
      login: id.toString(),
      encryptedToken:encryptedToken,
      clientUniqueId:clientUniqueId
    })

    if(encryptedToken && clientUniqueId){
      const decryptedToken:CustomAuthenticatedUserToken = await this.encryptor.decryptCustomToken(encryptedToken);
      await this.validateToken(decryptedToken,id.toString(),clientUniqueId, executingUser);
      return {
        login: id.toString(),
        encryptedToken: encryptedToken,
        clientUniqueId: clientUniqueId
      }
    }

    throw new InvalidAuthenticationError()
  }

  async update(id: string | number, entityToUpdate: Authentication, executingUser?: User): Promise<Authentication> {
    throw new Error('Not Implemented')
  }

  async canAuthenticate(login:string, uniqueClientId:string, executingUser?:User):Promise<boolean> {
    const userUseCases:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'User');
    const user:User = await userUseCases.get(login, executingUser);
    const ca = (await userUseCases.isValidUser(user, executingUser));
    return ca;
  }

  private async validateToken(decryptedToken: CustomAuthenticatedUserToken, userLogin: string, clientUniqueId?: string, executingUser?: User) {
    if(!userLogin)
      throw new InvalidAuthenticationError('No login');

    if(!clientUniqueId)
      throw new InvalidAuthenticationError('No client unique id');

    if(userLogin !== decryptedToken.login)
      throw new InvalidAuthenticationError('Wrong login');

    if(clientUniqueId !== decryptedToken.clientUniqueId)
      throw new InvalidAuthenticationError('Wrong client unique id');

    if(!this.validAuthorityKey(decryptedToken.authorityKey))
      throw new InvalidAuthenticationError('Wrong authority key');

    if(!(await this.canAuthenticate(userLogin, clientUniqueId, executingUser)))
      throw new InvalidAuthenticationError()

    if(!this.tokenNotExpired(decryptedToken))
      throw new InvalidAuthenticationError('Authentication expired')
    //Validate the expiration date
  }

  validAuthorityKey(authorityKey?: string) {
    return authorityKey && authorityKey === this.authorityKey;
  }

  tokenNotExpired(decryptedToken:CustomAuthenticatedUserToken) {
    return ((Date.now() - decryptedToken.authenticationDate.getTime())/1000) <= this.tokenTTL;
  }

  /**
   isAuthenticated(login:string, decryptedToken:CustomAuthenticatedUserToken): boolean {
    return login === decryptedToken.login &&
      this.validAuthorityKey(decryptedToken.authorityKey) &&
      this.userExists(decryptedToken.login) &&
      this.userIsActive(decryptedToken.login) &&
      this.tokenNotExpired(decryptedToken);
  }

   async userExists(login: string):Promise<boolean> {
    return await this.userStorage.exists(login);
  }

   async userIsActive(login: string):Promise<boolean> {
    if(await this.userExists(login)) {
      const user = await this.userStorage.get(login);
      return (user && user.isActive)?user.isActive:false;
    }
    return  false;
  }


   canAuthenticate(login: string, context: { clientUniqueId:string }): boolean {
    // TODO : test if login tries < 3
    // TODO : if login tries > 3, calculate login period and that you are in login period (increasing for each newest login tries
    return true;
  }
   */

}
