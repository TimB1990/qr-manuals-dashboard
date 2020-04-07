<template>
  <div>
    <div class="side-menu-container">
      <div class="side-menu-search">
            <input
            v-if="products"
            v-model="search"
            @input="updateProductFetch(1)"
            type="text"
            placeholder="Search Products..."
          />
            <i class="fa fa-search" aria-hidden="true"></i>
      </div>

      <div class="side-menu-block">
        <strong>products</strong>
        <button v-if="!loading" class="button is-loading is-small"></button>
      </div>

      <ul v-if="products.data && products.data.length">
        <side-menu-item
          v-for="product in products.data"
          :key="product.id"
          :product_id="product.id"
          :product_name="product.name"
          :product_artnr="product.artnr"
          :product_kind="product.kind"
          :product_stock="product.stock"
          :categories="product.categories"
        />
      </ul>

      <!-- paginator -->
      <div>
        <side-menu-paginator :pagination="products" :offset="2" @paginate="fetchProducts"></side-menu-paginator>
      </div>

      <!-- errors -->
      <div v-if="error" class="notification is-danger">
        <h3>Error!</h3>
        <div>{{ errorList }}</div>
      </div>
    </div>
  </div>
</template>


<script>
import SideMenuItem from "./SideMenuItem";
import SideMenuPaginator from "./SideMenuPaginator";
import _ from "lodash";

export default {
  name: "sideMenu",
  components: { SideMenuItem, SideMenuPaginator },

  data() {
    return {
      search: ""
    };
  },

  created() {
    this.fetchProducts(1);
  },

  methods: {
    fetchProducts(page) {
      this.$store.dispatch("fetchProducts", {
        page: page,
        query: this.search
      });
    },

    // use this to after user done typing the function is called. Keep notice that you must use function-syntax
    // use _.throttle to fire event every timeinterval (this case 800ms)

    updateProductFetch: _.debounce(function(page) {
      console.log('fetchProducts called')
      this.fetchProducts(1);
    }, 800)
  },

  clearProducts() {
    this.$store.dispatch("clearProducts");
  },

  clearSelected() {
    this.$store.dispatch("clearSelected");
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
.side-menu-block {
  display: flex;
  padding-top: 8px;
  padding-bottom: 8px;
  justify-content: space-between;
  align-items: center;
}

.side-menu-search{
  display: flex;
  flex-direction: row-reverse;
  border: 1px solid hsl(0,0%,80%);
  align-items: baseline;
  padding: 6px;
  border-radius: 6px;
}

.side-menu-search > i {
  padding: 6px;
}

.side-menu-container {
  background-color: white;
  padding: 12px;
  border-radius: 6px;
  box-shadow: 0 0.5em 1em -0.125em rgba(10, 10, 10, 0.1), 0 0px 0 1px rgba(10, 10, 10, 0.02);
}

.side-menu-search > input {
  padding: 6px;
  width: 100%;
  border: none;
  outline: transparent;
}
</style>