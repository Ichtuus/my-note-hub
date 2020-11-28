<template>
  <div class="modal-card" style="width: auto">
    <header class="modal-card-head">
      <p class="modal-card-title">Login</p>
      <button
          type="button"
          class="delete"
          @click="$emit('close')"/>
    </header>
    <section class="modal-card-body">
      <b-field label="Email">
        <b-input
            type="email"
            :value="email"
            placeholder="Your email"
            required>
        </b-input>
      </b-field>

      <b-field label="Password">
        <b-input
            type="password"
            :value="password"
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
</template>

<script lang="ts">
import {Vue, Component} from 'vue-property-decorator'

@Component({
  components: {  },
})
export default class AddNoteModal extends Vue {
}
</script>
