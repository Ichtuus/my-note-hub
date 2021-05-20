<template>
  <div>

    <div v-if="userAuthenticated && !isLoadingUser">

      <!--  SWITCH LAYOUT  -->
      <div class="columns">
        <div class="column is-12">
          <div class="is-pulled-right">
            <b-button @click="layout = 'list'" type="is-primary"><i class="fa fa-list" aria-hidden="true"/></b-button>
            <b-button @click="layout = 'grid'" type="is-primary"><i class="fas fa-th" aria-hidden="true"/></b-button>
          </div>
        </div>
      </div>
      <div class="base-app"></div>
      <!--  HUBS LIST  -->
      <hubs :hubs="hubs"/>

      <!--  NOTES GRID LAYOUT  -->
      <div v-if="layout === 'grid'">
        <div v-if="!isLoading && notes.length > 0">
          <note-list :layout="layout" :notes="notes"/>
        </div>
        <div v-else-if="isLoading && !notes.length > 0" class="has-text-centered">
          <i class="fas fa-spinner fa-pulse fa-2x fa-fw"/>
        </div>
        <div v-else>
          Sorry we have doesn't found note in this hub
        </div>
      </div>

      <!--  NOTES LIST LAYOUT  -->
      <div v-else-if="layout === 'list'">
        <div v-if="!isLoading && notes.length > 0">
          <note-list :layout="layout" :notes="notes"/>
        </div>
        <div v-else-if="isLoading && !notes.length > 0" class="has-text-centered">
          <i class="fas fa-spinner fa-pulse fa-2x fa-fw"/>
        </div>
        <div v-else>
          Sorry we have doesn't found note in this hub
        </div>
      </div>
      <div v-else>
        Layout error
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'
import { getModule } from 'vuex-module-decorators'
// @ts-ignore
import sses from '../tools/note/manage-topic'

import NoteModule from '../store/modules/note'
import UserModule from '../store/modules/user'
import HubModule from '../store/modules/hub'

import { APINote } from '../types/api/note/actions'
import { APIHubs } from '../types/api/hub/actions'

import NoteList from '../components/notes/layout/NoteList.vue'
import HeaderApp from '../components/globals/header/HeaderApp.vue'
import Hubs from '../components/hubs/Hubs.vue'
import Registration from '../public/Registration.vue'

@Component({
  components: { NoteList, HeaderApp, Hubs, Registration },
})
export default class Home extends Vue {
  public layout: string = 'grid'

  async mounted () {
    sses()
    await getModule( NoteModule, this.$store ).getNotes(this.userHubId)
    await getModule( HubModule, this.$store ).getHubs()
  }

  get userHubId (): string {
    return getModule( UserModule, this.$store ).userHubId
  }

  get notes (): APINote[] {
    return getModule( NoteModule, this.$store ).notes
  }

  get isLoading (): boolean {
    return getModule( NoteModule, this.$store ).isLoading
  }

  get hubs (): APIHubs[] {
    return getModule( HubModule, this.$store ).hubs
  }

  get userAuthenticated (): boolean {
    return getModule(UserModule, this.$store).userAuthenticated
  }

  get isLoadingUser (): boolean {
    return getModule(UserModule, this.$store).isLoading
  }
}
</script>
