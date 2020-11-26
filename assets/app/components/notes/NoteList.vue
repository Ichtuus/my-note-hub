<template>
  <div class="columns">
    <div v-for="note in notes" :key="note.id" class="column">
      <note-list-item :note="note"/>
    </div>
  </div>
</template>

<script lang="ts">
import {Vue, Component} from 'vue-property-decorator'
import NoteListItem from "./NoteListItem.vue"

@Component({
  components: { NoteListItem }
})
export default class NoteList extends Vue {
  notes: any = [
    {
      id: 1,
      title: 'My first note',
      content: 'An custom test content',
      first_link: 'www.google.com',
      second_link: null,
      third_link: 'www.phpnet.com',
      date_note: '11:09 PM - 1 Jan 2016'
    },
    {
      id: 2,
      title: 'My second note',
      content: 'An test content but i didn\'t what i say',
      first_link: 'www.google.com',
      second_link: null,
      third_link: 'www.phpnet.com',
      date_note: '11:09 PM - 1 Jan 2016'
    }
  ]

}
</script>
