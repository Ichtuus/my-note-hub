<template>
  <note-skeleton :current-note="note">
    <template v-slot:header>
      {{ note.note_title }}
    </template>
    <template v-slot:content-text>
      {{ note.note_content }}
    </template>
    <template v-slot:first-content-link>
      <a :href="note.note_first_link">{{ note.note_first_link }}</a>
    </template>
    <template v-slot:second-content-link>
      <a :href="note.note_second_link">{{ note.note_second_link }}</a>
    </template>
    <template v-slot:third-content-link>
      <a :href="note.note_third_link">{{ note.note_third_link }}</a>
    </template>
    <template v-slot:date>
      <time v-if="note.creation_datetime" datetime="2016-1-1">{{ new Date(note.creation_datetime) | date }}</time>
    </template>
  </note-skeleton>
</template>

<script lang="ts">
import {Vue, Component, Prop} from 'vue-property-decorator'
import NoteSkeleton from '../../NoteSkeleton.vue'
import { APINote } from '../../../../types/api/note/actions'

@Component({
  components: { NoteSkeleton }
})
export default class NoteGridItem extends Vue {
  @Prop( { type: Object, required: true } ) readonly note!: APINote
}
</script>
