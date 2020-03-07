<template>
  <li ref="item" @click="fetchDetails(product_id)">
    <ul>
      <li>{{ product_name }}</li>
      <li>{{ product_artnr }} | {{ product_kind }}</li>
    </ul>
    <nav class="breadcrumb is-small">
      <ul v-if="categories">
        <li v-for="(category,i) of categories" :key="i">
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
    },

    fetchDetails(id) {
      console.log("navigate to details of:", id);
      this.$router.replace({
        name: "product_details",
        params: {
          id: id
        }
      }).catch(err => {});
    }
  }
};
</script>

<style scoped>
.is-selected {
  background-color: #cc0033;
  color: white;
}
</style>