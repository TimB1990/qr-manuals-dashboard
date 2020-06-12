<template>
    <div class="content-root">
        <!-- this should become a modal -->

        <!-- side menu sheets -->
        <div v-for="item in qrsheets" :key="item.id">
            <side-sheet-item
                :sheet_id="item.id"
                :alias="item.alias"
                :product_amount="item.product_amount"
                :pages="item.pages"
                :createdAt="convertCreatedAt(item)"
                :updatedAt="convertUpdatedAt(item)"
            >
            </side-sheet-item>
        </div>
    </div>
</template>
<script>
import moment from "moment";
import SideSheetItem from "./components/SideSheetItem";

export default {
    name: "sideSheets",
    components: { SideSheetItem },

    created() {
        this.fetchQrSheets();
    },
    methods: {
        fetchQrSheets() {
            this.$store.dispatch("fetchQrSheets");
        },

        convertCreatedAt(item) {
            if (this.qrsheets) {
                return moment(item.created_at).format("DD-MM-YYYY, HH:mm");
            }
        },
        convertUpdatedAt(item) {
            if (this.qrsheets) {
                return moment(item.updated_at).format("DD-MM-YYYY, HH:mm");
            }
        },
    },
    computed: {
        qrsheets() {
            return this.$store.state.qrsheets;
        }
    }
};
</script>
