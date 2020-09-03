export class UserEntity {

  static validateId(id? : string| number):number {
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

  static validatePassword(password: string):boolean {
    let regexp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/g
    const valid = regexp.test(password);
    if(!valid) {
      throw new Error('Password must be 8 characters minimum, contains UpperCase and LowerCase, at least 1 number and 1 special character except < or >')
    }
    return valid;
  }

  static validateLogin(login: string):boolean {
    let regexp = /^[a-zA-Z0-9]{5,}$/g
    const valid = regexp.test(login);
    if(!valid) {
      throw new Error('Login must be 5 characters minimum, with only letters and numbers ')
    }
    return valid;
  }
}
