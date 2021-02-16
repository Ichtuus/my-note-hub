<template>
  <b-navbar-item tag="div">
    <div class="buttons">
      <button @click="registerModal()" class="button is-primary">
        <strong>Sign up</strong>
      </button>
      <button @click="loginModal()" class="button is-light">
        Log in
      </button>
    </div>
  </b-navbar-item>
</template>

<script lang="ts">
import {Vue, Component} from 'vue-property-decorator'
import LoginModal from './user/account/modal/LoginModal.vue'
import RegisterModal from './user/account/modal/RegisterModal.vue'

@Component({
  components: { RegisterModal, LoginModal },
})
export default class Registration extends Vue {
  registerModal (): any {
    this.$buefy.modal.open({
      parent: this,
      component: RegisterModal,
    })
  }
  loginModal () {
    this.$buefy.modal.open({
      parent: this,
      component: LoginModal,
    })
  }
}
</script>
