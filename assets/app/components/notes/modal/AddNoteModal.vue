<template>
  <div class="modal-card" style="width: auto">
    <header class="modal-card-head">
      <p class="modal-card-title">Add a note</p>
      <button
          type="button"
          class="delete"
          @click="$emit('close')"/>
    </header>
    <section class="modal-card-body">
      <b-field label="Title">
        <b-input
            type="text"
            v-model="note_title"
            placeholder="Title of your new note"
            required>
        </b-input>
      </b-field>

      <b-field label="Content">
        <b-input
            maxlength="200"
            type="textarea"
            v-model="note_content"
            placeholder="Content of your new note"
            required>
        </b-input>
      </b-field>

      <b-field label="first-link">
        <b-input
            type="text"
            v-model="note_first_link"
            placeholder="First link">
        </b-input>
      </b-field>

      <b-field label="second-link">
        <b-input
            type="text"
            v-model="note_second_link"
            placeholder="Second link">
        </b-input>
      </b-field>

      <b-field label="third-link">
        <b-input
            type="text"
            v-model="note_third_link"
            placeholder="Third link">
        </b-input>
      </b-field>

    </section>
    <footer class="modal-card-foot">
      <button class="button" type="button" @click="$emit('close')">Close</button>
      <button @click="createNote" class="button is-primary">Let's go !</button>
    </footer>
  </div>
</template>

<script lang="ts">
import {Vue, Component} from 'vue-property-decorator'
import { getModule } from 'vuex-module-decorators'
import NoteModule from '../../../store/modules/note'
import { APINote } from '../../../types/api/note/actions'

@Component
export default class AddNoteModal extends Vue {
  private note_title: string = ''
  private note_content: string = ''
  private note_first_link: string = ''
  private note_second_link: string = ''
  private note_third_link: string = ''

  async createNote (): Promise<any> {
    const newNote: any = {
      note_title: this.note_title,
      note_content: this.note_content,
      note_first_link: this.note_first_link,
      note_second_link: this.note_second_link,
      note_third_link: this.note_third_link
    }
    await getModule(NoteModule, this.$store).addNote({newNote, id: this.userHubId})
  }

   get userHubId(): string {
    return this.$store.getters['user/userHubId'];
  }
}
</script>
