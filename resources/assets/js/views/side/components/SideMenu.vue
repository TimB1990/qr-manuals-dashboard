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

      <div class="custom-panel-block">
        <strong>products</strong>
        <button v-if="!loading" class="button is-loading is-small"></button>
      </div>

      <p v-if="this.selectedProducts">
        {{ this.selectedProducts }}
        <button @click.prevent="clearSelected">clear</button>
        </p>

      <ul v-if="products.data && products.data.length">
        <side-menu-item
          v-for="product in products.data"
          :key="product.id"
          :product_id="product.id"
          :product_name="product.name"
          :product_artnr="product.artnr"
          :product_kind="product.kind"
          :categories="product.categories"
        />
        <hr />
      </ul>

      <!-- paginator -->
      <div>
        <side-menu-paginator :pagination="products" :offset="1" @paginate="fetchProducts"></side-menu-paginator>
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
import SideMenuPaginator from "./SideMenuPaginator";

export default {
  name: "sideMenu",
  components: { SideMenuItem, SideMenuPaginator },

  created() {
    this.fetchProducts(1);
  },

  methods: {
    fetchProducts(page) {
      this.$store.dispatch("fetchProducts", {
        page: page
      });
    },

    clearProducts() {
      this.$store.dispatch("clearProducts");
    },

    clearSelected(){
      this.$store.dispatch('clearSelected');
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
    },
    selectedProducts() {
      return this.$store.state.selectedProducts;
    }
  }
};
</script>

<style scoped>
.custom-panel-block {
  display: flex;
  padding-left: 16px;
  padding-right: 16px;
  padding-top: 8px;
  padding-bottom: 8px;
  justify-content: space-between;
  align-items: center;
}
</style>