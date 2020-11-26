<template>
  <div class="card">
    <header class="card-header">
      <p class="card-header-title">
        <slot name="header"></slot>
      </p>
      <a href="#" class="card-header-icon" aria-label="more options">
      <span class="icon">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
      </span>
      </a>
    </header>
    <div class="card-content">
      <div class="content">
        <slot name="content-text"></slot>
        <slot name="first-link"></slot> <slot name="second-link"></slot> <slot name="third-link"></slot>
        <br>
        <slot name="date"></slot>
<!--        <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>-->
      </div>
    </div>
<!--    <footer class="card-footer">-->
<!--      <a href="#" class="card-footer-item">Save</a>-->
<!--      <a href="#" class="card-footer-item">Edit</a>-->
<!--      <a href="#" class="card-footer-item">Delete</a>-->
<!--    </footer>-->
  </div>
</template>

<script lang="ts">
import {Vue, Component} from 'vue-property-decorator'

@Component({
  components: {  }
})
export default class NoteSkeleton extends Vue {
}
</script>
