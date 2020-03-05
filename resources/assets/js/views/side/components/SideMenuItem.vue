<template>
  <li @click="select" ref="item">
    <ul>
      <li>{{ product_name }}</li>
      <li>{{ product_artnr }} | {{ product_kind }}</li>
    </ul>
    <nav class="breadcrumb is-small">
      <ul v-if="categories">
        <li v-for="category of categories" :key="category.id">
          <a href="#">{{ category.name }}</a>
        </li>
      </ul>
    </nav>
  </li>
</template>

<script>
export default {
  name: "sideMenuItem",
  props: {
    product_id: Number,
    product_artnr: String,
    product_name: String,
    product_kind: String,
    categories: Array
  },
  methods: {
    select() {
      this.$refs["item"].classList.toggle("is-selected");
    }
  }
};
</script>

<style scoped>
</style>