export class FEServices {

    services:{ [serviceName:string]:any };

    constructor() {
        this.services = {}
    }

    registerService(serviceName:string, service:any) {
        this.services[serviceName] = service;
    }

    getService(serviceName:string) {
        return this.services[serviceName];
    }
}

export const globalFEService = new FEServices();
(window as any).globalFEService = globalFEService;