<template>
  <home/>
</template>

<script lang="ts">
import {Vue, Component} from 'vue-property-decorator'
import Home from './public/Home'
import sses from './tools/note/manage-topic'
@Component({
  components: { Home },
  mounted() {
    sses()
  }
})
export default class App extends Vue {
}
</script>
