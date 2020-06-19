<template>
    <div class="content-root">
        <div v-if="!loading" class="menu-header">
            <span>Loading...</span>
            <span class="side-load"></span>
        </div>

        <div class="menu-header-2">
            <div class="search">
                <i class="fa fa-search" aria-hidden="true"></i>
                <input
                    @input="updateSheetFetch($event.target.value, 1)"
                    type="text"
                    placeholder="Search Sheet Alias..."
                />
            </div>
        </div>

        <!-- side menu sheets -->
        <div v-if="qrsheets">
            <side-sheet-item
                :key="item.id"
                v-for="item in qrsheets.data"
                :sheet_id="item.id"
                :alias="item.alias"
                :product_amount="item.product_amount"
                :pages="item.pages"
                :createdAt="convertCreatedAt(item)"
                :updatedAt="convertUpdatedAt(item)"
            >
            </side-sheet-item>
        </div>
        <div>
            <side-menu-paginator
                :pagination="qrsheets"
                :offset="2"
                @paginate="fetchQrSheets(query)"
            ></side-menu-paginator>
        </div>
    </div>
</template>
<script>
import moment from "moment";
import SideSheetItem from "./components/SideSheetItem";
import SideMenuPaginator from "./components/SideMenuPaginator";

export default {
    name: "sideSheets",
    components: { SideSheetItem, SideMenuPaginator },

    created() {
        this.fetchQrSheets("", 1);
    },

    data() {
        return {
            page: 1,
            query: ""
        };
    },
    methods: {
        fetchQrSheets(query, page) {
            this.query = query;
            this.page = page;

            this.$store.dispatch("fetchQrSheets", {
                page: page,
                query: this.query,
            });
        },

        updateSheetFetch: _.debounce(function(query, page) {
            this.query = query;
            this.fetchQrSheets(query, page);
        }, 800),

        convertCreatedAt(item) {
            if (this.qrsheets) {
                return moment(item.created_at).format("DD-MM-YYYY, HH:mm");
            }
        },
        convertUpdatedAt(item) {
            if (this.qrsheets) {
                return moment(item.updated_at).format("DD-MM-YYYY, HH:mm");
            }
        }
    },
    computed: {
        qrsheets() {
            return this.$store.state.qrsheets;
        },

        selectedProducts() {
            return this.$store.state.selectedProducts;
        },

        loading() {
            return this.$store.state.loadingStatus === "notloading";
        }
    }
};
</script>
