<template>
    <div>
        <div class="content-root">
            <div v-if="this.$route.name == 'sheet-new' || this.$route.name == 'sheet-edit'" class="panel">
                <button
                    @click="setSelectionMode('single')"
                    :class="{
                        'panel-btn': true,
                        active: selectionMode == 'single'
                    }"
                >
                    Single
                </button>
                <button
                    @click="setSelectionMode('multi')"
                    :class="{
                        'panel-btn': true,
                        active: selectionMode == 'multi'
                    }"
                >
                    Multi
                </button>
            </div>
            <div class="menu-header">
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
            <div v-else>
                <em>There Are No Products In Database</em>
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
        {{ selectedProducts }}
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
        },

        setSelectionMode(mode) {
            this.$store.dispatch('clearSelected')
            this.$store.dispatch("setSelectionMode", {
                mode: mode
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

        selectionMode() {
            return this.$store.state.selectionMode;
        }
    }
};
</script>
