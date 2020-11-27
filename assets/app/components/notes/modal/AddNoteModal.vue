<template>
  <b-modal ref="add-note-modal" v-model="isActive" :width="640" scroll="keep">
    <div class="card">
      <div class="card-content">
        <div class="media">
          <div class="media-left">
            <figure class="image is-48x48">
              <img src="/static/img/placeholder-1280x960.png" alt="Image">
            </figure>
          </div>
          <div class="media-content">
            <p class="title is-4">John Smith</p>
            <p class="subtitle is-6">@johnsmith</p>
          </div>
          <b-button @click="close($myModalConst('ADD'))">close</b-button>
        </div>

        <div class="content">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          Phasellus nec iaculis mauris. <a>@bulmaio</a>.
          <a>#css</a> <a>#responsive</a>
          <br>
          <small>11:09 PM - 1 Jan 2016</small>
        </div>
      </div>
    </div>
  </b-modal>
</template>

<script lang="ts">
import {Component, Prop, Mixins} from 'vue-property-decorator'
import {ModalManager} from '../../../mixins/modal/modalManager'

@Component({
  components: {  },
})
export default class AddNoteModal extends  Mixins(ModalManager) {
  @Prop( { type: Boolean | undefined, required: true } ) readonly isActive: boolean
}
</script>
