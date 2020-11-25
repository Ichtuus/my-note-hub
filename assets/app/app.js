import 'babel-polyfill';
import Vue from "vue";
import axios from 'axios'

import App from "./App";


axios.defaults.withCredentials = true;

Vue.config.productionTip = false
new Vue({
  el: '#app',
  components: { App },
  template: '<App/>'
});
