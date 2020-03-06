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

      <ul v-if="products.data && products.data.length">
        <side-menu-item
          class="side-menu-item"
          v-for="product in products.data"
          :key="product.id"
          :product_name="product.name"
          :product_artnr="product.artnr"
          :product_kind="product.kind"
          :categories="product.categories"
        />
        <hr />
      </ul>

      <!-- paginator -->
      <div>
        <side-menu-paginator :pagination="products" :offset=1 @paginate="fetchProducts"></side-menu-paginator>
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

  mounted() {
    this.fetchProducts(1);
  },

  methods: {
    fetchProducts(page) {
      this.$store.dispatch("fetchProducts",{
        page: page
      });
      
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

<style scoped>
.side-menu-item {
  /*background-color: hsl(0, 0%, 96%);*/
  /*box-shadow: 0 2px 6px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19);*/
  display: flex;
  flex-direction: column;
  border: 1px solid hsl(0, 0%, 86%);
  padding: 8px;
  margin-bottom: 14px;
  margin-left: 14px;
  margin-right: 14px;
  border-radius: 4px;
  height:100px;
}

.side-menu-item:hover {
  background-color: hsl(0, 0%, 96%);
}

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