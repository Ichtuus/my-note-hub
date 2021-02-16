<template>
  <note-skeleton :current-note="note">
    <template v-slot:header>
      {{ note.note_title }}
    </template>
    <template v-slot:content-text>
      {{ note.note_content }}
    </template>
    <template v-slot:first-content-link>
      <a :href="note.first_link">{{ note.first_link }}</a>
    </template>
    <template v-slot:second-content-link>
      <a :href="note.second_link">{{ note.second_link }}</a>
    </template>
    <template v-slot:third-content-link>
      <a :href="note.third_link">{{ note.third_link }}</a>
    </template>
    <template v-slot:date>
      <time datetime="2016-1-1">{{ note.creation_datetime }}</time>
    </template>
  </note-skeleton>
</template>

<script lang="ts">
import {Vue, Component, Prop} from 'vue-property-decorator'
import NoteSkeleton from './NoteSkeleton.vue'
import { APINote } from '../../types/api/note/actions'

@Component({
  components: { NoteSkeleton }
})
export default class NoteListItem extends Vue {
  @Prop( { type: Object, required: true } ) readonly note!: APINote
}
</script>
