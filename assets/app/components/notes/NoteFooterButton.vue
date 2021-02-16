<template>
  <footer class="card-footer">
    <b-button disabled type="is-info is-light" class="card-footer-item">Save</b-button>
    <b-button type="is-primary is-light" class="card-footer-item" @click="patchNoteModal">Edit</b-button>
    <b-button type="is-danger is-light" class="card-footer-item" @click="deleteNote(currentNote)">Delete</b-button>
  </footer>
</template>

<script lang="ts">
import {Vue, Component, Prop} from 'vue-property-decorator'
import EditNoteModal from './modal/EditNoteModal.vue'
import { getModule } from 'vuex-module-decorators'
import NoteModule from '../../store/modules/note'
import { APINote } from '../../types/api/note/actions'

@Component
export default class NoteFooterButton extends Vue {
  @Prop( { type: Object, required: true } ) readonly currentNote!: APINote

  patchNoteModal (): any {
    this.$buefy.modal.open({
      parent: this,
      component: EditNoteModal,
      props: {currentNote: this.currentNote}
    })
  }

  async deleteNote (note: APINote): Promise<any> {
    this.$buefy.dialog.confirm({
      title: 'Deleting this note',
      message: 'Are you sure you want to <b>delete</b> your this note ? This action cannot be undone.',
      confirmText: 'Delete Note',
      type: 'is-danger',
      hasIcon: true,
      onConfirm: async () => {
        console.log(note)
        await getModule(NoteModule, this.$store).delete({ noteId: note.id })
      }
    })
  }
}
</script>
