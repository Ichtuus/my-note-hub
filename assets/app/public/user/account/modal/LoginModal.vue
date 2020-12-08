<template>
  <form method="post" :action="url">
    <div class="modal-card" style="width: auto">
      <header class="modal-card-head">
        <p class="modal-card-title">Login</p>
      </header>
      <section class="modal-card-body">

        <b-field label="Username">
          <b-input
              type="text"
              name="_username"
              placeholder="Your username"
              required>
          </b-input>
        </b-field>

        <b-field label="Password">
          <b-input
              type="password"
              name="_password"
              password-reveal
              placeholder="Your password"
              required>
          </b-input>
        </b-field>

        <b-checkbox>Remember me</b-checkbox>
      </section>
      <footer class="modal-card-foot">
        <button class="button" type="button" @click="$emit('close')">Close</button>
        <button class="button is-primary">Login</button>
      </footer>
    </div>
  </form>
</template>

<script lang="ts">
import {Vue, Component} from 'vue-property-decorator'

@Component({
  components: {  }
})
export default class LoginModal extends Vue {
  loginUrl =  Routing.generate( 'mnh_user_login' )

  get url () {
    return this.loginUrl
  }
}
</script>
