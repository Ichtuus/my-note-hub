<template>
  <div>
    <!-- Loading if we are not user authenticated -->
    <b-loading :is-full-page="true" v-model="isLoading" :can-cancel="false"></b-loading>
    <div v-if="userAuthenticated && !isLoading">
      <!-- Home -->
      <home/>
    </div>
    <div v-else>
      <!-- Registration Button-->
      <registration/>
    </div>
  </div>
</template>

<script lang="ts">
import {Vue, Component} from 'vue-property-decorator'
import {mapGetters} from 'vuex'
import Home from './public/Home.vue'
import Registration from './public/Registration.vue'
// @ts-ignore
import sses from './tools/note/manage-topic'
import {getModule} from 'vuex-module-decorators'
import UserModule from './store/modules/user'

@Component({
  components: { Home, Registration }
})
export default class App extends Vue {
  async beforeCreate( ) {
    sses()
    await getModule (UserModule, this.$store).information()
  }

  get userAuthenticated (): boolean {
    return getModule(UserModule, this.$store).userAuthenticated
  }
  get isLoading (): boolean {
    return getModule(UserModule, this.$store).isLoading
  }
}
</script>
