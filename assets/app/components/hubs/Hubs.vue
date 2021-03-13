<template>
  <div>
    <hubs-list :hubs="hubs"/>
  </div>
</template>

<script lang="ts">
import {Vue, Component, Prop} from 'vue-property-decorator'
import { APIHubs } from '../../types/api/hub/actions'

import HubsList from './layout/HubList.vue'

@Component({
  components: { HubsList }
})
export default class Hubs extends Vue {
  @Prop( { type: Array, required: true } ) readonly hubs!: APIHubs[]

}
</script>
