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
        <span type="is-info">{{ props.row.note_first_link }}</span>
      </b-table-column>

      <b-table-column field="second_link" label="Second link" sortable v-slot="props">
        <span type="is-info">{{ props.row.note_second_link }}</span>
      </b-table-column>

      <b-table-column field="third_link" label="Third link" sortable v-slot="props">
        <span type="is-info">{{ props.row.note_third_link }}</span>
      </b-table-column>

      <b-table-column field="actions" label="Actions" v-slot="props">
        <note-footer-button :current-note="props.row"/>
      </b-table-column>
    </b-table>
  </section>
</template>

<script lang="ts">
import {Vue, Component, Prop} from 'vue-property-decorator'
import NoteFooterButton from '../../NoteFooterButton.vue'

@Component({
  components: { NoteFooterButton }
})
export default class NoteListItem extends Vue {
  @Prop({type: Array, required: true}) readonly notes: any
}
</script>
