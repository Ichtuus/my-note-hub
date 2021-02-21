<template>
  <div>
    <div class="tile is-ancestor" v-for="hub in hubs" :key="hub.id">
      <div class="tile is-vertical is-8">
        <div class="tile">
          <vertical-blocs :hub="hub"/>
          <div class="tile is-parent">
            <article class="tile is-child notification is-primary">
              <p class="title">Middle tile</p>
              <p class="subtitle">With an image</p>
              <div class="content">
                <!-- Content -->
              </div>
            </article>
          </div>
        </div>
        <div class="tile is-parent">
          <article class="tile is-child notification is-primary">
            <p class="title">Wide tile</p>
            <p class="subtitle">Aligned with the right tile</p>
            <div class="content">
              <!-- Content -->
            </div>
          </article>
        </div>
      </div>
      <div class="tile is-parent">
        <article class="tile is-child notification is-primary">
          <div class="content">
            <p class="title">Tall tile</p>
            <p class="subtitle">With even more content</p>
            <div class="content">
              <!-- Content -->
            </div>
          </div>
        </article>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import {Vue, Component, Prop} from 'vue-property-decorator'
import { APIHub } from '../../types/api/hub/actions'

import VerticalBlocs from './layout/blocs/vertical/VerticalBlocs.vue'
import MiddleBlocs from './layout/blocs/middle/MiddleBlocs.vue'
import TallBlocs from './layout/blocs/tall/TallBlocs.vue'
import WideBlocs from './layout/blocs/wide/WideBlocs.vue'

@Component({
  components: {
    VerticalBlocs,
    MiddleBlocs,
    TallBlocs,
    WideBlocs
  }
})
export default class Hubs extends Vue {
  @Prop( { type: Array, required: true } ) readonly hubs!: APIHub[]

}
</script>
