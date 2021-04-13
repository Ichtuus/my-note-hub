<template>
  <div class="columns">
    <div class="column column pl-0 pr-0">
      <b-navbar>
        <template slot="brand">
          <b-navbar-item>
            <router-link :to="{ name: 'Home' }">
              <span class="header-label header-label-1">My</span>
              <span class="header-label header-label-2">Note</span>
              <span class="header-label header-label-3">Hub</span>
            </router-link>
          </b-navbar-item>
        </template>
        <template slot="start">
          <b-navbar-item href="#">Home</b-navbar-item>
          <b-navbar-item href="#">Documentation</b-navbar-item>
          <b-navbar-dropdown :label="currentHub.name">
            <router-link :to="{ name: 'hub_show_settings', params: { id: currentHub.id }  }">
            <b-navbar-item>
              Settings
            </b-navbar-item>
            </router-link>
          </b-navbar-dropdown>
          <b-navbar-item style="margin-left: 260px">
            <div class="buttons">
              <button class="button is-primary is-medium"
                      @click="addNoteModal()">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </b-navbar-item>
        </template>

        <template slot="end">
          <b-navbar-item tag="div">
            <div class="buttons">
              <a :href="logoutUrl" class="button is-danger is-medium">
                <strong>Log out</strong>
              </a>
            </div>
          </b-navbar-item>
        </template>
      </b-navbar>
    </div>
  </div>
</template>

<script lang="ts">
import {Vue, Component} from 'vue-property-decorator'
import AddNoteModal from '../../notes/modal/AddNoteModal.vue'
import {APIHub} from '../../../types/api/hub/actions'
import {getModule} from 'vuex-module-decorators'
import HubModule from '../../../store/modules/hub'

@Component({
  components: { AddNoteModal },
})
export default class HeaderApp extends Vue {
  logoutUrl: string =  Routing.generate( 'mnh_user_logout' )

  addNoteModal(): any {
    this.$buefy.modal.open({
      parent: this,
      component: AddNoteModal,
    })
  }
  get url (): any {
    return this.logoutUrl
  }

  get currentHub (): APIHub {
    return getModule(HubModule, this.$store).hub
  }
}
</script>
