<template>
  <div>
    <div class="columns">
      <div class="column is-12">
        <section class="hero">
          <div class="hero-body pl-0 pr-0">
            <p class="title">
              {{ isHubUser ? 'Our hub' : 'Hub of' }} {{ hub.creator ? hub.creator.username : ''}}
              <span class="is-pulled-right"></span>
            </p>
            <p class="subtitle">
              <span v-if="hub.creationDatetime"><small> Created on {{ new Date(hub.creationDatetime) | date }}</small></span>
            </p>
          </div>
        </section>
      </div>
    </div>

    <div v-if="notes.length > 0">
      <note-list :notes="notes" layout="grid"/>
    </div>

    <div v-else-if="isNoteLoading && !notes.length > 0" class="has-text-centered">
      <i class="fas fa-spinner fa-pulse fa-2x fa-fw"/>
    </div>
    <div v-else>
      Sorry we have doesn't found note in this hub
    </div>
  </div>
</template>


<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'
import { getModule } from 'vuex-module-decorators'
import NoteModule from '../../../store/modules/note'
import HubModule from '../../../store/modules/hub'

import NoteList from '../../notes/layout/NoteList.vue'
import UserModule from "../../../store/modules/user";

@Component({
  components: { NoteList }
})
export default class Hub extends Vue {
  private hubId: string = this.$route.params.id

  async mounted () {
    await getModule(NoteModule, this.$store).getNotes(this.hubId)
    await getModule(HubModule, this.$store).getHub(this.hubId)
  }

  get isHubUser (): boolean {
    return this.hubId === this.userHubId
  }

  get notes () {
    return getModule(NoteModule, this.$store).notes
  }

  get isNoteLoading () {
    return getModule(NoteModule, this.$store).isLoading
  }

  get hub () {
    return getModule(HubModule, this.$store).hub
  }

  get userHubId () {
    return getModule(UserModule, this.$store).userHubId
  }

}
</script>
