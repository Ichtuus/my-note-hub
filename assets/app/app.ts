import 'babel-polyfill'
import Vue from "vue"
import App from "./App"
import axios from 'axios'
import Buefy from 'buefy'

import store from "./store"

import 'buefy/dist/buefy.css'


Vue.use(Buefy)

axios.defaults.withCredentials = true

Vue.config.productionTip = false
new Vue({
  el: '#app',
  store,
  components: { App },
  template: '<App/>'
});
