export class UserEntity {

  static convertId(id? : string| number):number {
    if(typeof id === 'number')
      return id;
    if(typeof id === 'string') {
      try {
        let idToParse = parseInt(id);
        if(idToParse)
          return idToParse;
      }catch(err) {
        //DO nothing, just a test to parse id to number
      }
    }
    throw new Error('id must be a number');
  }

  static validateId(id? : string| number):boolean {
    if(typeof id === 'number')
      return true;
    if(typeof id === 'string') {
      try {
        let idToParse = parseInt(id);
        if(idToParse)
          return true;
      }catch(err) {
        //DO nothing, just a test to parse id to number
      }
    }
    return false;
  }

  static validatePassword(password: string):boolean {
    let regexp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/g
    return regexp.test(password);
  }

  static validateLogin(login: string):boolean {
    let regexp = /^[a-zA-Z0-9]{5,}$/g
    return regexp.test(login);
  }
}
