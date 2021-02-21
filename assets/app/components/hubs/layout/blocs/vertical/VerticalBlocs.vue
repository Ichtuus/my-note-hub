<template>
  <div class="tile is-parent is-vertical">
    <article class="tile is-child notification is-primary">
      <p class="title">Vertical...</p>
      <p class="subtitle">Top tile</p>
      <div class="content">
        <!-- Content -->
      </div>
    </article>
    <article class="tile is-child notification is-primary">
      <p class="title">...tiles</p>
      <p class="subtitle">Bottom tile</p>
      <div class="content">
        <!-- Content -->
      </div>
    </article>
  </div>
</template>

<script lang="ts">
import {Vue, Component, Prop} from 'vue-property-decorator'
import { APIHub } from '../../../../../types/api/hub/actions'

@Component
export default class VerticalBlocs extends Vue {
  @Prop( { type: Array, required: true } ) readonly hub!: APIHub

}
</script>
