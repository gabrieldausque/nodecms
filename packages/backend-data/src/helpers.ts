export function isNumber(toTest: any): boolean {
    if(typeof toTest === 'number')
      return true;
    if(toTest !== null && typeof toTest !== 'undefined') {
      const regexpIsNumber = /^[0-9]+$/g;
      return regexpIsNumber.test(toTest.toString())
    }
    return false;
}
