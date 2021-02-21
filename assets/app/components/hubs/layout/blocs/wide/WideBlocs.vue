<template>

</template>

<script lang="ts">
import {Vue, Component, Prop} from 'vue-property-decorator'
import { APIHub } from '../../../../../types/api/hub/actions'

@Component
export default class WideBlocs extends Vue {
  @Prop( { type: Array, required: true } ) readonly hub!: APIHub

}
</script>
