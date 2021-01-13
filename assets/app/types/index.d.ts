/* eslint-disable camelcase */
declare module '*.vue' {
  import Vue from 'vue'
  export default Vue
}

declare const Routing: {
  generate(name:string, opt_params?:Record<string, any>, absolute?:boolean):string;
}
