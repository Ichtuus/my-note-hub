<template>
  <div class="tile is-ancestor">
    <hub-item v-for="hub in hubs" :key="hub.id" :hub="hub"/>
  </div>
</template>


<script lang="ts">
import {Vue, Component, Prop} from 'vue-property-decorator'
import { APIHubs } from '../../../types/api/hub/actions'
import HubItem from './blocs/HubItem.vue'

@Component({
  components: { HubItem }
})
export default class HubList extends Vue {
  @Prop( { type: Array, required: true } ) readonly hubs!: APIHubs[]

}
</script>
