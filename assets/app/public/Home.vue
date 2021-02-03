<template>
  <div class="columns">
    <div class="column is-1"></div>
    <div class="column is-10">
      <header-app class="mb-6"/>
      <div class="columns">
        <div class="column is-12">
          <div class="is-pulled-right">
            <b-button @click="layout = 'list'" type="is-primary"><i class="fa fa-list" aria-hidden="true"/></b-button>
            <b-button @click="layout = 'grid'" type="is-primary"><i class="fas fa-th" aria-hidden="true"/></b-button>
          </div>
        </div>
      </div>
      <div v-if="layout === 'grid'">
        <div v-if="!isLoading && notes.length > 0">
          <note-list :layout="layout" :notes="notes"/>
        </div>
        <div v-else-if="!isLoading" class="has-text-centered">
          <i class="fas fa-spinner fa-pulse fa-4x fa-fw"/>
        </div>
        <div v-else>
          Notes not found
        </div>
      </div>
      <div v-else-if="layout === 'list'">
        <note-list :layout="layout" :notes="notes"/>
      </div>
      <div v-else>
        Layout error
      </div>
    </div>
    <div class="column is-1"></div>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'
import NoteList from '../components/notes/NoteList.vue'
import HeaderApp from '../components/globals/header/HeaderApp.vue'
import { getModule } from 'vuex-module-decorators'
import NoteModule from '../store/modules/note'
import UserModule from '../store/modules/user'
import { APINote } from '../types/api/note/actions'

@Component({
  components: { NoteList, HeaderApp },
})
export default class Home extends Vue {
  public layout = 'grid'

  async mounted () {
    await getModule( NoteModule, this.$store ).get(this.userHubId)
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
}
</script>
