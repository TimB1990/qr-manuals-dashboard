<template>
    <div @click="gotoSheetDetails(sheet_id)" :class="{'side-item':true, 'active':sheet_id == this.$route.params.id}">
        <div class="item-header">
            <span>Sheet ID</span>
            <span>#{{ sheet_id }}</span>
        </div>
        <table>
            <tr>
                <td><b>alias:</b></td>
                <td>{{ alias }}</td>
            </tr>
            <tr>
                <td><b>products:</b></td>
                <td>{{ product_amount }}</td>
            </tr>
            <tr>
                <td><b>total pages:</b></td>
                <td>{{ pages }}</td>
            </tr>
            <tr>
                <td><b>created at:</b></td>
                <td>{{ createdAt }}</td>
            </tr>
            <tr>
                <td><b>Last update:</b></td>
                <td>{{ updatedAt }}</td>
            </tr>
        </table>
    </div>
</template>
<script>
export default {
    name: "sideSheetItem",
    props: {
        sheet_id: Number,
        alias: String,
        product_amount: Number,
        pages: Number,
        createdAt: String,
        updatedAt: String
    },
    methods: {
        gotoSheetDetails(sheetId) {
            this.$router.replace({
                name: "sheet-details",
                params: {
                    id: sheetId
                }
            });
        },
    }
};
</script>
