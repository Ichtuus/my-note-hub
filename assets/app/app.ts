import 'babel-polyfill'
import Vue from "vue"
import App from "./App"
import axios from 'axios'
import Buefy from 'buefy'

import store from "./store"
import myModalConst from './constants/plugins/myModal'

import 'buefy/dist/buefy.css'


Vue.use(Buefy)
Vue.use(myModalConst);

axios.defaults.withCredentials = true

Vue.config.productionTip = false
new Vue({
  el: '#app',
  store,
  components: { App },
  template: '<App/>'
});
