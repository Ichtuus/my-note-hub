<template>
  <note-list/>
</template>

<script lang="ts">
import {Vue, Component} from 'vue-property-decorator'
import NoteList from "../components/notes/NoteList.vue"

@Component({
  components: { NoteList }
})
export default class Home extends Vue {
}
</script>
