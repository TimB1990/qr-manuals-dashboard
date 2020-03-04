<template>
  <div>
    <a @click="select" class="level panel-block" ref="item">
      <span class="level-left level-item">{{ product_name }}</span>
      <span class="panel-icon is-large level-item has-text-right">
        <i class="fa fa-check" aria-hidden="true"></i>
      </span>
    </a>
  </div>
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