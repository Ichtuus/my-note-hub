<template>
  <div class="columns">
    <div v-for="note in notes" :key="note.id" class="column mt-6">
      <note-list-item v-if="layout === 'list'" :note="note"/>
      <note-grid-item v-if="layout === 'grid'" :notes="notes"/>
    </div>
  </div>
</template>

<script lang="ts">
import {Vue, Component, Prop} from 'vue-property-decorator'
import NoteListItem from './NoteListItem.vue'
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
