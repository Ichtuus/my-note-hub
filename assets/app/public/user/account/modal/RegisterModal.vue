<template>
  <div class="modal-card" style="width: auto">
    <header class="modal-card-head">
      <p class="modal-card-title">Registration</p>
      <button
          type="button"
          class="delete"
          @click="$emit('close')"/>
    </header>
    <section class="modal-card-body">
      <b-field label="Username">
        <b-input
            type="text"
            v-model="username"
            placeholder="Your name"
            required>
        </b-input>
      </b-field>

      <b-field label="Email">
        <b-input
            type="email"
            v-model="email"
            placeholder="Your email"
            required>
        </b-input>
      </b-field>

      <b-field label="Password">
        <b-input
            type="password"
            v-model="password"
            password-reveal
            placeholder="Your password"
            required>
        </b-input>
      </b-field>
    </section>
    <footer class="modal-card-foot">
      <button class="button" type="button" @click="$emit('close')">Close</button>
      <button @click="register" class="button is-primary">Register</button>
    </footer>
  </div>
</template>

<script lang="ts">
import {Vue, Component} from 'vue-property-decorator'
import {getModule} from "vuex-module-decorators";
import UserModule from "../../../../store/modules/user";

@Component({
  components: {  },
})
export default class RegistrationModal extends Vue {
  private username: string = ''
  private email: string = ''
  private password: string = ''

  register () {
    const payload: any = {
      username: this.username,
      email: this.email,
      password: this.password
    }
    getModule(UserModule, this.$store).registration(payload)
  }
}
</script>
