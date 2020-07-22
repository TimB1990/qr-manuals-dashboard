<template>
    <div>
        <div class="content-root">
            <div class="menu-header-2">
                <div class="search">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <input
                        v-model="query"
                        @input="updateProductFetch(1)"
                        type="text"
                        placeholder="Search Products..."
                    />
                </div>
            </div>

            <div v-if="!loading" class="menu-header">
                <span>loading...</span>
                <span class="side-load"></span>
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
            <div v-else>
                <em>No Results Found</em>
            </div>

            <div>
                <side-menu-paginator
                    :pagination="products"
                    :offset="2"
                    @paginate="fetchProducts"
                ></side-menu-paginator>
            </div>
        </div>
    </div>
</template>

<script>
import SideMenuItem from "./components/SideMenuItem";
import SideMenuPaginator from "./components/SideMenuPaginator";
import { debounce } from "lodash"; 

export default {
    name: "sideSheetProducts",
    components: { SideMenuItem, SideMenuPaginator },

    data() {
        return {
            query: "",
        };
    },
    created() {
        this.fetchProducts(1)        
    },

    methods: {
        fetchProducts(page) {
            this.$store.dispatch("fetchProducts", {
                page: page,
                query: this.query,
                feed: false
            });
        },

        updateProductFetch: debounce(function(page) {
            this.fetchProducts(1);
        }, 800)
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
