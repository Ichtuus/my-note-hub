<template>
  <div>
<!--    userAuthenticated = {{userAuthenticated}} <br> isLoadingUser = {{isLoadingUser}}-->
    <div v-if="!userAuthenticated && !isLoadingUser">
      <registration/>
    </div>

    <div v-else-if="isLoadingUser">
      <b-loading :is-full-page="true" v-model="isLoadingUser" :can-cancel="false"></b-loading>
    </div>

    <div v-else>
      <div class="columns">
        <div class="column is-1"></div>
        <div class="column is-10">

          <!--  HEADER  -->
          <header-app class="mb-6"/>
          <router-view></router-view>
        </div>
        <div class="column is-1"></div>
      </div>
    </div>

  </div>
</template>

<script lang="ts">
import {Vue, Component} from 'vue-property-decorator'
import { getModule } from 'vuex-module-decorators'
import UserModule from './store/modules/user'

import Home from './public/Home.vue'
import Registration from './public/Registration.vue'
import HeaderApp from "./components/globals/header/HeaderApp.vue";
@Component({
  components: { Home, Registration, HeaderApp }
})
export default class App extends Vue {

  async mounted () {
    await getModule (UserModule, this.$store).information()
  }

  get userAuthenticated (): boolean {
    return getModule(UserModule, this.$store).userAuthenticated
  }

  get isLoadingUser (): boolean {
    return getModule(UserModule, this.$store).isLoading
  }
}
</script>
