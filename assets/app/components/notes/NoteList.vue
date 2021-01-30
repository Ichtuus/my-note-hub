<template>
  <div class="columns">
<!--    notes = {{notes}}-->
    <div v-for="note in notes" :key="note.id" class="column mt-6">
      <note-list-item :note="note"/>
    </div>
  </div>
</template>

<script lang="ts">
import {Vue, Component, Prop} from 'vue-property-decorator'
import NoteListItem from "./NoteListItem.vue"

@Component({
  components: { NoteListItem }
})
export default class NoteList extends Vue {
  @Prop( { type: Array, required: true } ) readonly notes!: any
}
</script>
