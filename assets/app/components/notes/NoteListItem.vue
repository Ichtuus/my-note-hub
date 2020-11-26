<template>
  <note-skeleton>
    <template v-slot:header>
      {{ note.title }}
    </template>
    <template v-slot:content-text>
      {{ note.content }}
    </template>
    <template v-slot:content-text>
      {{ note.content }}
    </template>
    <template v-slot:first-content-link>
      {{ note.first_link }}
    </template>
    <template v-slot:second-content-link>
      {{ note.second_link }}
    </template>
    <template v-slot:third-content-link>
      {{ note.third_link }}
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
  @Prop( { type: Object, required: true }) readonly note: any
}
</script>
