<template>
  <div style="cursor: pointer" class="tile is-parent">
    <router-link :to="{ name: 'hubs_show', params: {id: hub.id} }">
      <article class="tile is-child box notification is-primary">
        <p class="title"> {{ hub.name }} </p>
        <p class="subtitle">{{ hub.creator }} | {{ hub.creation_datetime }}</p>
        <div class="content">
          <!-- Content -->
        </div>
      </article>
    </router-link>
  </div>
</template>

<script lang="ts">
import {Vue, Component, Prop} from 'vue-property-decorator'
import { APIHub } from '../../../../types/api/hub/actions'

@Component
export default class WideBlocs extends Vue {
  @Prop( { type: Object, required: true } ) readonly hub!: APIHub

}
</script>
