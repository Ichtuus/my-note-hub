import 'babel-polyfill'
import Vue from 'vue'
import App from './App.vue'
import axios from 'axios'
import Buefy from 'buefy'

import store from './store'
import router from './router'
import { Route } from 'vue-router'

import 'buefy/dist/buefy.css'
import { createDateFilter } from 'vue-date-fns'

Vue.use(Buefy)
Vue.filter("date", createDateFilter('d MMMM yyyy'));

axios.defaults.withCredentials = true

Vue.config.productionTip = false

declare module 'vue/types/vue' {
  interface Vue {
    $route: Route
  }
}

new Vue({
  el: '#app',
  store,
  router,
  components: { App },
  template: '<App/>'
});
