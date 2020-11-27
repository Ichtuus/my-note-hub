<template>
  <div class="columns">
    <div class="column is-1"></div>
    <div class="column is-10">
      <header-app class="mb-5"/>
      <note-list/>
    </div>
    <div class="column is-1"></div>
  </div>
</template>

<script lang="ts">
import {Vue, Component} from 'vue-property-decorator'
import NoteList from '../components/notes/NoteList.vue'
import HeaderApp from '../components/globals/header/HeaderApp.vue'

@Component({
  components: { NoteList, HeaderApp }
})
export default class Home extends Vue {
}
</script>
