<template>
  <section>
    <b-table :data="notes">
      <b-table-column field="note_title" label="Title" v-slot="props">
        {{ props.row.note_title }}
      </b-table-column>

      <b-table-column field="creation_datetime" label="Date" v-slot="props">
        {{ props.row.creation_datetime }}
      </b-table-column>

      <b-table-column field="note_content" label="Content" sortable v-slot="props">
        {{ props.row.note_content }}
      </b-table-column>

      <b-table-column field="first_link" label="First link" sortable v-slot="props">
        <span type="is-info">{{ props.row.first_link }}</span>
      </b-table-column>

      <b-table-column field="second_link" label="Second link" sortable v-slot="props">
        <span type="is-info">{{ props.row.second_link }}</span>
      </b-table-column>

      <b-table-column field="third_link" label="Third link" sortable v-slot="props">
        <span type="is-info">{{ props.row.third_link }}</span>
      </b-table-column>
    </b-table>
  </section>
</template>

<script lang="ts">
import {Vue, Component, Prop} from 'vue-property-decorator'

@Component
export default class NoteListItem extends Vue {
  @Prop( { type: Array, required: true } ) readonly notes: any
  columns = [
      {note_title:'note_title', label: 'Title'},
      {creation_datetime: 'creation_datetime', label: 'Date'},
      {note_content: 'note_content', label: 'Content'},
      {first_link: 'first_link', label: 'First link'},
      {second_link: 'second_link', label: 'Second link'},
      {third_link:'third_link', label: 'Third link'}]
}
</script>
