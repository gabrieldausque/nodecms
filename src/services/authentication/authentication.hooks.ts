import {disallowMethod} from '../helpers';

export default {
  before: {
    all: [],
    find: [
      disallowMethod,
      (ctx:any) => {}
    ],
    get: [],
    create: [],
    update: [],
    patch: [
      disallowMethod,
      (ctx:any) => {}
    ],
    remove: [
      disallowMethod,
      (ctx:any) => {}
    ]
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
