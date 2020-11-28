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

@Component({
  components: { NoteListItem }
})
export default class NoteList extends Vue {
  notes: any = [
    {
      id: 1,
      note_title: 'My first note',
      note_content: 'An custom test content',
      first_link: 'www.google.com',
      second_link: null,
      third_link: 'www.phpnet.com',
      note_date: '11:09 PM - 1 Jan 2016'
    },
    {
      id: 2,
      note_title: 'My second note',
      note_content: 'An test content but i didn\'t what i say',
      note_first_link: 'www.google.com',
      note_second_link: null,
      note_third_link: 'www.phpnet.com',
      note_date: '11:09 PM - 1 Jan 2016'
    },
    {
      id: 3,
      note_title: 'My third note',
      note_content: 'Other test content',
      note_first_link: 'www.google.com',
      note_second_link: null,
      note_third_link: 'www.phpnet.com',
      note_date: '11:09 PM - 1 Jan 2016'
    },
    {
      id: 4,
      note_title: 'My fourth note',
      note_content: 'Last test content',
      note_first_link: 'www.google.com',
      note_second_link: null,
      note_third_link: 'www.phpnet.com',
      note_date: '11:09 PM - 1 Jan 2016'
    }
  ]

}
</script>
