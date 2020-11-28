import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import note from './modules/note'

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    note
  },
  strict: debug,
})


