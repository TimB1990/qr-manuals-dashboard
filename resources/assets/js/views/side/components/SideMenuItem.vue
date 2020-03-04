<template>
    <a @click="select" class="panel-block" ref="item">
      {{ product_name }}
      <span class="panel-icon is-large level-item">
        <i class="fa fa-check" aria-hidden="true"></i>
      </span>
    </a>
</template>

<script>
export default {
  name: "sideMenuItem",
  props: {
    selected: {
      type: Boolean,
      default: false
    },
    product_id: Number,
    product_artnr: String,
    product_name: String,
    categories: Array
  },
  methods: {
    select() {
      this.$refs["item"].classList.toggle("is-active");
    }
  }
};
</script>