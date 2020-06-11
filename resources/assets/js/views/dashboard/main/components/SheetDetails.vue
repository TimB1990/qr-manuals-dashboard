<template>
    <!-- use only this.object in script -->
    <div class="content-root">
        <div v-if="deleteDialog" class="warn-dialog">
            <span>Are you sure you want to delete this sheet permanently?</span>
            <div>
                <button @click="cancelDestroy" class="panel-btn">no</button>
                <button @click="destroySheet(currentSheetID)" class="panel-btn">
                    yes
                </button>
            </div>
        </div>
        <table class="content-table">
            <thead>
                <tr>
                    <td colspan="2">Sheet Details</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>id</td>
                    <td>{{ sheet.id }}</td>
                </tr>
                <tr>
                    <td>alias</td>
                    <td>{{ sheet.alias }}</td>
                </tr>
                                <tr>
                    <td>pages</td>
                    <td>{{ sheet.pages }}</td>
                </tr>
                <tr>
                    <td>width</td>
                    <td>{{ sheet.page_width_mm}}mm</td>
                </tr>
                                <tr>
                    <td>height</td>
                    <td>{{ sheet.page_height_mm}}mm</td>
                </tr>
                <tr>
                    <td>rows</td>
                    <td>{{ sheet.rows_per_page}}</td>
                </tr>
                                <tr>
                    <td>columns</td>
                    <td>{{ sheet.cols_per_page}}</td>
                </tr>
                <tr>
                    <td>products</td>
                    <td>{{ sheet.product_amount }}</td>
                </tr>
            </tbody>
        </table>

        <table class="content-table">
            <thead>
                <tr>
                    <td colspan="3">Items</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><b>Product ID</b></td>
                    <td><b>Productcode</b></td>
                    <td><b>kind</b></td>
                </tr>
                <tr v-for="item in sheet.items" :key="item.id">
                    <td>{{ item.id }}</td>
                    <td>{{ item.artnr }}</td>
                    <td>{{ item.kind }}</td>
                </tr>
            </tbody>

        </table>
    </div>
</template>

<script>
import moment from "moment";

export default {
    name: "sheetDetails",
    created() {
        this.fetchSheet(this.$route.params.id);
    },
    data() {
        return {
            deleteDialog: false,
            currentSheetAlias: null,
            currentSheetID: null
        };
    },
    methods: {
        fetchSheet(id) {
            this.$store.dispatch("fetchQrSheet", {
                sheet_id: id
            });
        },
        toggleDeleteDialog(sheetAlias, currentSheetID) {
            this.currentSheetID = currentSheetID;
            this.currentSheet = sheetAlias;
            this.deleteDialog = !this.deleteDialog;
        },

        destroySheet(currentSheetID) {
            this.$store.dispatch("deleteSheet", {
                id: currentSheetID
            });

            this.deleteDialog = false;
        },

        cancelDestroy() {
            this.deleteDialog = false;
            this.currentSheetAlias = null;
            this.currentSheetID = null;
        }
    },
    computed: {
        sheet() {
            let sheet = this.$store.state.qrsheet;
            return sheet;
        }
    }
};
</script>
