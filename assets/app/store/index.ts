import Vue from 'vue'
import Vuex from 'vuex'
import myModals from './modules/myModals'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'


export default new Vuex.Store({
  modules: {
    myModals
  },
  strict: debug,
})


