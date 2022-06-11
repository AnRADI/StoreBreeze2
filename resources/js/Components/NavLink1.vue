<template>
  <li class="nav-item">
    <Link :href="href" :class="classes">
      <slot></slot>
    </Link>
  </li>
</template>

<script>
  export default {
    props: ['href', 'active'],

    computed: {
      classes() {
        return this.active
            ? 'nav-link active font-weight-bolder'
            : 'nav-link'
      }
    }
  }
</script>
