<template>
  <div class="modal-card" style="width: auto">
    <header class="modal-card-head">
      <p class="modal-card-title">Edit a note</p>
      <button
          type="button"
          class="delete"
          @click="$emit('close')"/>
    </header>
    <section class="modal-card-body">
      <b-field v-if="currentNote.note_title" label="Title">
        <b-input
            type="text"
            v-model="payload.note_title"
            placeholder="Title of your new note"
            required>
        </b-input>
      </b-field>

      <b-field v-if="currentNote.note_content" label="Content">
        <b-input
            maxlength="200"
            type="textarea"
            v-model="payload.note_content"
            placeholder="Content of your new note"
            required>
        </b-input>
      </b-field>

      <b-field v-if="currentNote.note_first_link" label="first-link">
        <b-input
            type="text"
            v-model="payload.note_first_link"
            placeholder="First link">
        </b-input>
      </b-field>

      <b-field v-if="currentNote.note_second_link" label="second-link">
        <b-input
            type="text"
            v-model="payload.note_second_link"
            placeholder="Second link">
        </b-input>
      </b-field>

      <b-field v-if="currentNote.note_third_link" label="third-link">
        <b-input
            type="text"
            v-model="payload.note_third_link"
            placeholder="Third link">
        </b-input>
      </b-field>

    </section>
    <footer class="modal-card-foot">
      <button class="button" type="button" @click="$emit('close')">Close</button>
      <button @click="patch" class="button is-primary">Update now !</button>
    </footer>
  </div>
</template>

<script lang="ts">
import {Vue, Component, Prop} from 'vue-property-decorator'
import { getModule } from 'vuex-module-decorators'
import NoteModule from '../../../store/modules/note'
import { APINote } from '../../../types/api/note/actions'

@Component
export default class EditNoteModal extends Vue {
  @Prop( { type: Object, required: true } ) readonly currentNote!: APINote

  private payload: any = {
    note_title: '',
    note_content: '',
    note_first_link: '',
    note_second_link: '',
    note_third_link: ''
  }

  mounted (): any {
    this.payload.note_title = this.currentNote.note_title
    this.payload.note_content = this.currentNote.note_content
    this.payload.note_first_link = this.currentNote.note_first_link
    this.payload.note_second_link = this.currentNote.note_second_link
    this.payload.note_third_link = this.currentNote.note_third_link
  }

  async patch (): Promise<any> {
    await getModule(NoteModule, this.$store).patchNote({noteId: this.currentNote.id, payload: this.payload})
  }
}
</script>
