import {Logger} from "./Logger";
import * as chalk from 'chalk';
const clc = new chalk.Instance({level: 1})

export class ConsoleLogger implements Logger {
  public static metadata : any[] = [
    {
      contractType:'Logger',
      contractName:'Default',
      isShared:true
    },
    {
      contractType:'Logger',
      contractName:'Default',
      isShared:true
    }
  ]

  format(message:string, level:string='info') {
    return `[${level.toUpperCase()}] ${new Date()} ${message}`
  }

  debug(message: string): void {

    console.debug(clc.green(this.format(message, 'debug')).toString());
  }

  error(message: string): void {
    console.error(clc.red(this.format(message, 'error')))
  }

  info(message: string): void {
    console.info(clc.white(this.format(message, 'info')));
  }

  warning(message: string): void {
    console.warn(clc.keyword('orange')(this.format(message, 'warning')));
  }

}
