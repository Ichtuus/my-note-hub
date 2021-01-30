<template>
  <div class="columns">
    <div class="column is-1"></div>
    <div class="column is-10">
      <header-app class="mb-6"/>
      <div class="columns">
        <div class="column is-12">
          <div class="is-pulled-right">
            <b-button type="is-primary" class="card-footer-item"><i class="fa fa-list" aria-hidden="true"></i></b-button>
            
          </div>
        </div>
      </div>
      <div v-if="!isLoading && notes.length > 0">
        <note-list :notes="notes"/>
      </div>
      <div v-else-if="!isLoading" class="text-center">
          <i class="fas fa-spinner fa-pulse fa-1x fa-fw"/>
      </div>
      <div v-else>
        Notes not found
      </div>
    </div>
    <div class="column is-1"></div>
  </div>
</template>

<script lang="ts">
import {Vue, Component} from 'vue-property-decorator'
import NoteList from '../components/notes/NoteList.vue'
import HeaderApp from '../components/globals/header/HeaderApp.vue'
import {getModule} from "vuex-module-decorators";
import NoteModule from "../store/modules/note";
import UserModule from "../store/modules/user";

@Component({
  components: { NoteList, HeaderApp },
})
export default class Home extends Vue {
  async mounted () {
    await getModule( NoteModule, this.$store ).get(this.userHubId)
  }

  get userHubId () {
    return getModule( UserModule, this.$store ).userHubId
  }

  get notes () {
    return getModule( NoteModule, this.$store ).notes
  }

  get isLoading () {
    return getModule( NoteModule, this.$store ).isLoading
  }
}
</script>
