<template>
  <div>
  <b-navbar>
    <template slot="brand">
      <b-navbar-item>
        <span class="header-label header-label-1">My</span>
        <span class="header-label header-label-2">Note</span>
        <span class="header-label header-label-3">Hub</span>
      </b-navbar-item>
    </template>
    <template slot="start">
      <b-navbar-item href="#">
        Home
      </b-navbar-item>
      <b-navbar-item href="#">
        Documentation
      </b-navbar-item>
      <b-navbar-dropdown label="Info">
        <b-navbar-item href="#">
          About
        </b-navbar-item>
        <b-navbar-item href="#">
          Contact
        </b-navbar-item>
      </b-navbar-dropdown>
      <b-navbar-item style="margin-left: 260px">
        <div class="buttons">
          <button class="button is-primary is-medium"
                  @click="open($myModalConst('ADD'))">
            <i class="fas fa-plus"></i>
          </button>
        </div>
        <i class="fas fa-plus"></i>
      </b-navbar-item>
    </template>

    <template slot="end">
      <b-navbar-item tag="div">
        <div class="buttons">
          <a class="button is-primary">
            <strong>Sign up</strong>
          </a>
          <a class="button is-light">
            Log in
          </a>
        </div>
      </b-navbar-item>
    </template>
  </b-navbar>
    <add-note-modal :isActive="isActive"/>
  </div>
</template>

<script lang="ts">
import {Vue, Component, Mixins} from 'vue-property-decorator'
import AddNoteModal from '../../notes/modal/AddNoteModal.vue'
import {ModalManager} from '../../../mixins/modal/modalManager'

@Component({
  components: { AddNoteModal },
  computed: {
    isActive() {
      return this.$store.getters['myModals/isActive'] (!this.currentModal ? 'default' : this.currentModal)
    },
    currentModal() {
      return this.$store.getters['myModals/currentModal']
    }
  },
})
export default class HeaderApp extends Mixins(ModalManager) {}
</script>
