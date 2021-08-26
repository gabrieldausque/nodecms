import {disallowMethod} from "../helpers";

export default {
  before: {
    all: [],
    find: [],
    get: [],
    create: [],
    update: [
      disallowMethod,
      (ctx:any) => {}],
    patch: [],
    remove: []
  },

  after: {
    all: [],
    find: [],
    get: [],
    create: [],
    update: [],
    patch: [],
    remove: []
  },

  error: {
    all: [],
    find: [],
    get: [],
    create: [],
    update: [],
    patch: [],
    remove: []
  }
};
