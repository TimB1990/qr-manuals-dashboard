<template>
    <div>
        <div class="content-root">
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
                <side-menu-paginator
                    :pagination="products"
                    :offset="2"
                    @paginate="fetchProducts"
                ></side-menu-paginator>
            </div>

            <!-- errors -->
            <div v-if="error">
                <h3>Error!</h3>
                <div>{{ errorList }}</div>
            </div>
        </div>
    </div>
</template>

<script>
import SideMenuItem from "./components/SideMenuItem";
import SideMenuPaginator from "./components/SideMenuPaginator";

export default {
    name: "sideMenu",
    components: { SideMenuItem, SideMenuPaginator },
    created() {
        this.fetchProducts(1);
    },
    methods: {
        fetchProducts(page) {
            this.$store.dispatch("fetchProducts", {
                page: page,
                query: ""
            });
        }
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
        },
    }
};
</script>
