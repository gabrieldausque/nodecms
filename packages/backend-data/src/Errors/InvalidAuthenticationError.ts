export class InvalidAuthenticationError extends Error {
  constructor(msg:string = 'Your authentication is invalid.') {
    super(msg);
  }
}
