<template>
    <nav class="actionbar" role="actionbar" aria-label="actionbar">
        <div class="actionbar-start">
            <i @click="toggleProducts" class="fas fa-bars"></i>


        </div>
        <div class="actionbar-end">
            <div class="search">
                <input
                    v-model="search"
                    @input="updateProductFetch(1)"
                    type="text"
                    placeholder="Search Products..."
                />
                <i class="fa fa-search" aria-hidden="true"></i>
            </div>
        </div>
    </nav>
</template>

<script>
import _ from "lodash";
export default {
    name: "productsActionBar",
    components: {},
    created() {
        this.fetchProducts(1);
    },
    data() {
        return {
            qrAmount: 1,
            search: ""
        };
    },
    methods: {
        toggleProducts(){
            this.$store.dispatch("toggleSideMenu", {
                show: null
            })
        },
        fetchProducts(page) {
            this.$store.dispatch("fetchProducts", {
                page: page,
                query: this.search
            });
        },

        updateProductFetch: _.debounce(function(page) {
            console.log("fetchProducts called");
            this.fetchProducts(1);
        }, 800),

        clearProducts() {
            this.$store.dispatch("clearProducts");
        }
    },

    computed: {
        selectedProducts() {
            return this.$store.state.selectedProducts;
        }
    }
};
</script>
