<template>
  <note-skeleton>
    <template v-slot:header>
      {{ note.note_title }}
    </template>
    <template v-slot:content-text>
      {{ note.note_content }}
    </template>
    <template v-slot:first-content-link>
      <a :href="note.note_first_link">First link</a>
    </template>
    <template v-slot:second-content-link>
      <a :href="note.note_second_link">Second link</a>
    </template>
    <template v-slot:third-content-link>
      <a :href="note.note_third_link">Third link</a>
    </template>
    <template v-slot:date>
      <time datetime="2016-1-1">{{ note.note_date }}</time>
    </template>
  </note-skeleton>
</template>

<script lang="ts">
import {Vue, Component, Prop} from 'vue-property-decorator'
import NoteSkeleton from "./NoteSkeleton.vue"

@Component({
  components: { NoteSkeleton }
})
export default class NoteListItem extends Vue {
  @Prop( { type: Object, required: true } ) readonly note: any
}
</script>
