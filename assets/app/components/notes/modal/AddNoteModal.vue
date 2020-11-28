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
            :value="note_title"
            placeholder="Title of your new note"
            required>
        </b-input>
      </b-field>

      <b-field label="Content">
        <b-input
            maxlength="200"
            type="textarea"
            :value="note_content"
            placeholder="Content of your new note"
            required>
        </b-input>
      </b-field>

      <b-field label="first-link">
        <b-input
            type="text"
            :value="note_first_link"
            placeholder="First link">
        </b-input>
      </b-field>

      <b-field label="second-link">
        <b-input
            type="text"
            :value="note_second_link"
            placeholder="Second link">
        </b-input>
      </b-field>

      <b-field label="third-link">
        <b-input
            type="text"
            :value="note_third_link"
            placeholder="Third link">
        </b-input>
      </b-field>

    </section>
    <footer class="modal-card-foot">
      <button class="button" type="button" @click="$emit('close')">Close</button>
      <button class="button is-primary">Let's go !</button>
    </footer>
  </div>
</template>

<script lang="ts">
import {Vue, Component} from 'vue-property-decorator'

@Component({
  components: {  },
})
export default class AddNoteModal extends Vue {
  note_title: string = ''
  note_content: string = ''
  note_first_link: string = ''
  note_second_link: string = ''
  note_third_link: string = ''
}
</script>
