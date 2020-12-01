import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import note from './modules/note'
import user from './modules/user'

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    note,
    user
  },
  strict: debug,
})


