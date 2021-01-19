<template>
  <footer class="card-footer">
    <b-button disabled type="is-info is-light" class="card-footer-item">Save</b-button>
    <b-button type="is-primary is-light" class="card-footer-item" @click="patchNoteModal">Edit</b-button>
    <b-button type="is-danger is-light" class="card-footer-item">Delete</b-button>
  </footer>
</template>

<script lang="ts">
import {Vue, Component, Prop} from 'vue-property-decorator'
import EditNoteModal from './modal/EditNoteModal.vue'
import {INote} from "../../store/models/note";

@Component({
  components: {  }
})
export default class NoteFooterButton extends Vue {
  @Prop( { type: Object, required: true } ) readonly currentNote!: INote

  patchNoteModal() {
    this.$buefy.modal.open({
      parent: this,
      component: EditNoteModal,
      props: {currentNote: this.currentNote}
    })
  }
}
</script>
