<template>
  <div :class="cardInformation.color" class="mr-3 ml-3 mb-5">
    <h3 class="subtitle">{{ cardInformation.title }}</h3>
    <div class="block columns">
      <div class="column is-12">
        <b-image
            class="image is-128x128 has-background-white mnh-bor-rad"
            src="/build/images/avatar.png"
            alt="hubimg"
            responsive
            rounded
        ></b-image>
      </div>
    </div>

    <div class="block columns">
      <div class="column is-12">
        <b-field v-for="input in cardInformation.input" :key="input.id">
          <b-input
              :value="input.field"
              placeholder=""
              type="search"
              icon="magnify"
              icon-clickable
              @icon-click="">
          </b-input>
        </b-field>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import {Vue, Component, Prop} from 'vue-property-decorator'

@Component
export default class CardContent extends Vue {
  @Prop( { type: Object, required: true } ) readonly cardInformation!: any

}
</script>
