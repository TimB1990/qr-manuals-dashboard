<template>
    <!-- use only this.object in script -->
    <div class="content-root">
        <div v-if="deleteDialog" class="warn-dialog">
            <span>Are you sure you want to delete this sheet permanently?</span>
            <div>
                <button @click="cancelDestroy" class="panel-btn">no</button>
                <button @click="destroySheet(currentSheetID)" class="panel-btn">yes</button>
            </div>
        </div>
        <table class="content-table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Alias / Sheet name</td>
                    <td>Items Total</td>
                    <td>Max. Per Page</td>
                    <td>Total Pages</td>
                    <td>Created At</td>
                    <td>Updated At</td>
                    <td>Import</td>
                    <td>Download</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in qrsheets" :key="item.id">
                    <td>{{ item.id }}</td>
                    <td>{{ item.alias }}</td>
                    <td>{{ item.product_amount }}</td>
                    <td>{{ item.rows_per_page * item.cols_per_page }}</td>
                    <td>{{ item.pages }}</td>
                    <td>{{ convertCreatedAt(item) }}</td>
                    <td>{{ convertUpdatedAt(item) }}</td>
                    <td>
                        <a>
                            <i
                                @click="loadSingleSheet(item.id)"
                                class="fas fa-file-import"
                            ></i>
                        </a>
                    </td>
                    <td>
                        <a :href="`/api/qrsheets/${item.id}/download`">
                            <i class="fas fa-file-download"></i>
                        </a>
                    </td>
                    <td>
                        <a disabled>
                            <i @click="toggleDeleteDialog(item.alias, item.id)" class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <code></code>
    </div>
</template>

<script>
import moment from "moment";

export default {
    name: "sheetManager",
    data(){
        return {
            deleteDialog: false,
            currentSheetAlias: null,
            currentSheetID: null
        }
    },
    created() {
        this.fetchQrSheets();
    },
    methods: {
        fetchQrSheets() {
            this.$store.dispatch("fetchQrSheets");
        },

        toggleDeleteDialog(sheetAlias, currentSheetID){
            this.currentSheetID = currentSheetID
            this.currentSheet = sheetAlias
            this.deleteDialog = !this.deleteDialog
        },

        destroySheet(currentSheetID){
            this.$store.dispatch('deleteSheet', {
                id : currentSheetID
            })

            this.deleteDialog = false

        },

        cancelDestroy(){
            this.deleteDialog = false
            this.currentSheetAlias = null
            this.currentSheetID = null
        },

        loadSingleSheet(id) {
            this.$router.push({
                name: "qr-config-sheet",
                params: {
                    id: id
                }
            });
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
        }
    },
    computed: {
        qrsheets() {
            return this.$store.state.qrsheets;
        },
    }
};
</script>
