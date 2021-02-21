<template>
  <div class="columns">
    <note-grid-item class="column mt-6 p-0 mr-2" v-for="note in notes" :key="note.id" v-if="layout === 'grid'" :note="note"/>
    <note-list-item class="column mt-12" v-if="layout === 'list'" :notes="notes"/>
  </div>
</template>

<script lang="ts">
import {Vue, Component, Prop} from 'vue-property-decorator'
import NoteListItem from './list/NoteListItem.vue'
import { APINote } from '../../../types/api/note/actions'
import NoteGridItem from './grid/NoteGridItem.vue'

@Component({
  components: { NoteListItem, NoteGridItem }
})
export default class NoteList extends Vue {
  @Prop( { type: Array, required: true } ) readonly notes!: APINote
  @Prop( { type: String, required: true } ) readonly layout!: any
}
</script>
