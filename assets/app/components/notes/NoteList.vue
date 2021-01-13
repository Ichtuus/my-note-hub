<template>
  <div class="columns">
    <div v-for="note in notes" :key="note.id" class="column mt-6">
      <note-list-item :note="note"/>
    </div>
  </div>
</template>

<script lang="ts">
import {Vue, Component} from 'vue-property-decorator'
import NoteListItem from "./NoteListItem.vue"
import {getModule} from "vuex-module-decorators";
import NoteModule from "../../store/modules/note";
import UserModule from "../../store/modules/user";

@Component({
  components: { NoteListItem }
})
export default class NoteList extends Vue {
  async mounted () {
    await getModule( NoteModule, this.$store ).get(this.userHubId)
  }

  get userHubId () {
    return getModule( UserModule, this.$store ).userHubId
  }

  get notes () {
    return getModule( NoteModule, this.$store ).notes
  }
}
</script>
