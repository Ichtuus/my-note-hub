<template>
  <div class="columns">
    <div v-for="note in notes" :key="note.id" class="column mt-6">
      <note-list-item v-if="layout === 'list'" :notes="notes"/>
      <note-grid-item v-if="layout === 'grid'" :note="note"/>
    </div>
  </div>
</template>

<script lang="ts">
import {Vue, Component, Prop} from 'vue-property-decorator'
import NoteListItem from './layout/list/NoteListItem.vue'
import { APINote } from '../../types/api/note/actions'
import NoteGridItem from './layout/grid/NoteGridItem.vue'

@Component({
  components: { NoteListItem, NoteGridItem }
})
export default class NoteList extends Vue {
  @Prop( { type: Array, required: true } ) readonly notes!: APINote
  @Prop( { type: String, required: true } ) readonly layout!: any
}
</script>
