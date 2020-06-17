<template>
    <!-- use only this.object in script -->
    <div class="content-root">
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
                    <td>{{ sheet.page_width_mm }}mm</td>
                </tr>
                <tr>
                    <td>height</td>
                    <td>{{ sheet.page_height_mm }}mm</td>
                </tr>
                <tr>
                    <td>rows</td>
                    <td>{{ sheet.rows_per_page }}</td>
                </tr>
                <tr>
                    <td>columns</td>
                    <td>{{ sheet.cols_per_page }}</td>
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
                <tr v-for="(item,index) in sheet.items" :key="index">
                    <td>{{ item.id }}</td>
                    <td>{{ item.artnr }}</td>
                    <td>{{ item.kind }}</td>
                </tr>
            </tbody>
        </table>
        <div class="panel">
            <button @click="setSheetPreview(sheet.id)" class="panel-btn">
                Preview
            </button>
            <button @click="editSheet(sheet.id)" class="panel-btn">Edit</button>
            <a :href="`/api/qrsheets/${sheet.id}/download`" class="panel-btn"
                >Download</a
            >
            <button @click="destroySheet(sheet.id)" class="panel-btn">
                Destroy
            </button>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    name: "sheetDetails",
    created() {
        this.fetchSheet(this.$route.params.id);
    },
    watch: {
        $route(to,from){
            this.fetchSheet(this.$route.params.id);
        }
    },
    data() {
        return {
            deleteDialog: false,
            currentSheetAlias: null,
            currentSheetID: null
        };
    },
    methods: {
        fetchSheet(sheetId) {
            this.$store.dispatch("fetchQrSheet", {
                sheet_id: sheetId
            });
        },
        editSheet(sheetId) {
            this.$router.push({
                name: "sheet-edit",
                params: {
                    id: sheetId
                }
            });
        },

        setSheetPreview(sheetId) {
            // navigate to route
            this.$router.push({
                name: "sheet-preview",
                params: {
                    id: sheetId
                }
            });
        },

        destroySheet(id) {
            this.$store.dispatch("deleteSheet", {
                id: id
            });

            // navigate to sheets
            this.$route.push({ name: 'sheets'})

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
