<template>
  <div class="columns">
    <card-content class="mnh-user-settings column" :card-information="userInformations"/>
    <card-content class="mnh-hub-settings column" :card-information="hubInformations"/>
  </div>
</template>


<script lang="ts">
import {Vue, Component} from 'vue-property-decorator'
import CardContent from '../../globals/content/CardContent.vue'
import Randomizer from '../../../tools/randomizer'
import {APIHub} from '../../../types/api/hub/actions'
import {getModule} from 'vuex-module-decorators'
import HubModule from '../../../store/modules/hub'

@Component({
  components: { CardContent }
})
export default class HubSettings extends Vue {

  private readonly COLOR_CARD: string [] = [
    'has-background-primary-light',
    'has-background-link-light',
    'has-background-info-light',
    'has-background-success-light',
    'has-background-warning-light',
    'has-background-danger-light'
  ]

  get userInformations () {
    return {
      title: 'Manage you\'re informations',
      color: new Randomizer().getRandomValue(this.COLOR_CARD)
    }
  }

  get hubInformations () {
    return {
      title: 'Manage you\'re hub informations',
      color: new Randomizer().getRandomValue(this.COLOR_CARD),
      input: [
        { field: this.currentHub.creator.username },
        { field: this.currentHub.name }
      ]
    }
  }

  get currentHub (): APIHub {
    return getModule(HubModule, this.$store).hub
  }
}
</script>
