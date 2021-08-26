export class InvalidDataError extends Error {
    constructor(msg:string = 'The Data is invalid.') {
        super(msg);
    }
}