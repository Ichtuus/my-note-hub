<template>
  <div class="columns">
    <div class="column">
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
                      @click="addNoteModal()">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </b-navbar-item>
        </template>

        <template slot="end">
          <b-navbar-item tag="div">
            <div class="buttons">
              <button @click="registrationModal()" class="button is-primary">
                <strong>Sign up</strong>
              </button>
              <button @click="loginModal()" class="button is-light">
                Log in
              </button>
            </div>
          </b-navbar-item>
        </template>
      </b-navbar>
    </div>
  </div>
</template>

<script lang="ts">
import {Vue, Component} from 'vue-property-decorator'
import AddNoteModal from '../../notes/modal/AddNoteModal.vue'
import RegistrationModal from '../../../public/user/account/modal/RegistrationModal.vue'
// import LoginModal from '../../../public/user/account/modal/LoginModal.vue'
// LoginModal
@Component({
  components: { AddNoteModal, RegistrationModal },
  computed: {},
})
export default class HeaderApp extends Vue {
  addNoteModal() {
    this.$buefy.modal.open({
      parent: this,
      component: AddNoteModal,
    })
  }
  registrationModal() {
    this.$buefy.modal.open({
      parent: this,
      component: RegistrationModal,
    })
  }
  loginModal() {
    this.$buefy.modal.open({
      parent: this,
      component: AddNoteModal,
    })
  }
}
</script>
