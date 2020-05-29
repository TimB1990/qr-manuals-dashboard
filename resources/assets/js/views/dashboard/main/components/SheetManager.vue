<template>
    <!-- use only this.object in script -->
    <div class="content-root">
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
                            <i class="fas fa-file-import"></i>
                        </a>
                    </td>
                    <td>
                        <a :href="`/api/qrsheets/${item.id}/download`">
                            <i class="fas fa-file-download"></i>
                        </a>
                    </td>
                    <td>
                        <a disabled>
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import moment from "moment";

export default {
    name: "sheetManager",
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
