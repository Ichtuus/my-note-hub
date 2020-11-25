<template>
  <home/>
</template>

<script lang="ts">
import {Vue, Component} from 'vue-property-decorator'
import Home from './public/Home'

@Component({
  components: { Home }
})
export default class App extends Vue {
}
</script>
