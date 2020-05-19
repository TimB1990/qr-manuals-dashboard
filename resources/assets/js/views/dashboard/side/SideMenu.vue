<template>
  <div>
    <div class="content-root">
      <div class="search">
            <input
            v-if="products"
            v-model="search"
            @input="updateProductFetch(1)"
            type="text"
            placeholder="Search Products..."
          />
            <i class="fa fa-search" aria-hidden="true"></i>
      </div>

      <div class="menu-header">
        <strong>products</strong>
        <span v-if="!loading">Loading...</span>
      </div>

      <div v-if="products.data && products.data.length">
        <side-menu-item
          v-for="product in products.data"
          :key="product.id"
          :product_id="product.id"
          :product_name="product.name"
          :product_artnr="product.artnr"
          :product_kind="product.kind"
          :product_stock="parseInt(product.stock)"
          :product_unit_price="product.unit_price"
          :categories="product.categories"
        />
      </div>

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
import SideMenuItem from "./components/SideMenuItem";
import SideMenuPaginator from "./components/SideMenuPaginator";
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