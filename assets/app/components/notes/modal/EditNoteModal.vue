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
            v-model="currentNote.note_title"
            placeholder="Title of your new note"
            required>
        </b-input>
      </b-field>

      <b-field v-if="currentNote.note_content" label="Content">
        <b-input
            maxlength="200"
            type="textarea"
            v-model="currentNote.note_content"
            placeholder="Content of your new note"
            required>
        </b-input>
      </b-field>

      <b-field v-if="currentNote.first_link" label="first-link">
        <b-input
            type="text"
            v-model="currentNote.first_link"
            placeholder="First link">
        </b-input>
      </b-field>

      <b-field v-if="currentNote.second_link" label="second-link">
        <b-input
            type="text"
            v-model="currentNote.second_link"
            placeholder="Second link">
        </b-input>
      </b-field>

      <b-field v-if="currentNote.third_link" label="third-link">
        <b-input
            type="text"
            v-model="currentNote.third_link"
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
import {INote} from "../../../store/models/note";
import {getModule} from "vuex-module-decorators";
import NoteModule from "../../../store/modules/note";
import UserModule from "../../../store/modules/user";

@Component({
  components: {  },
})
export default class EditNoteModal extends Vue {
  @Prop( { type: Object, required: true } ) readonly currentNote!: INote

  patch () {
    console.log('init', this.currentNote.id)
    getModule(NoteModule, this.$store).patch(this.currentNote.id)
  }
}
</script>
