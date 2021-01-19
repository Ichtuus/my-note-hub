<template>
  <div class="columns">
    <div class="column is-1"></div>
    <div class="column is-10">
      <header-app class="mb-6"/>
      <div class="columns">
        <div class="column is-12">
          <div class="is-pulled-right">
            <b-button type="is-primary" class="card-footer-item"><i class="fa fa-list" aria-hidden="true"></i></b-button>
          </div>
        </div>
      </div>
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
  components: { NoteList, HeaderApp },
  mounted() {
  }
})
export default class Home extends Vue {
}
</script>
