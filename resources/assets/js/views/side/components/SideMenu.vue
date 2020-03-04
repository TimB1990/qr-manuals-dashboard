<template>
  <div>
    <aside class="panel is-primary">
      <div class="panel-block">
        <p class="control has-icons-left">
          <input class="input" type="text" placeholder="Search Products..." />
          <span class="icon is-left">
            <i class="fa fa-search" aria-hidden="true"></i>
          </span>
        </p>
      </div>

      <div class="panel-block">
        <span><button v-if="!loading" class="button is-loading"></button></span>
        <span><strong>product</strong></span>
      </div>

      <div v-if="products && products.length">
        <div v-for="product of products" :key="product.id">
          <side-menu-item :product_name="product.name" />
        </div>
      </div>

      <!-- errors -->
      <div v-if="error" class="notification is-danger">
        <h3>Error!</h3>
        <div>{{ errorList }}</div>
      </div>
    </aside>
  </div>
</template>

<script>
import SideMenuItem from "./SideMenuItem";
export default {
  name: "sideMenu",
  components: { SideMenuItem },

  created() {
    this.fetchProducts();
  },

  methods: {
    fetchProducts() {
      this.$store.dispatch("fetchProducts");
    },
    clearProducts() {
      this.$store.dispatch("clearProducts");
    }
  },

  computed: {
    // no local data(), only computed properties
    products() {
      return this.$store.state.products;
    },
    loading() {
      return this.$store.state.loadingStatus === "notloading";
    },
    error() {
      return this.$store.state.errors.length > 0;
    },
    errorList() {
      return this.$store.state.errors;
    }
  }
};
</script>