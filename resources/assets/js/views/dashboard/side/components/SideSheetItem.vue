<template>
    <div @click="gotoSheetDetails(sheet_id)" class="side-item">
        <ul>
            <li>id: {{ sheet_id }}</li>
            <li>alias: {{ alias }}</li>
            <li>products: {{ product_amount }}</li>
            <li>total pages: {{ pages }}</li>
            <li>created at: {{ createdAt }}</li>
            <li>Last update: {{ updatedAt }}</li>
        </ul>
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
            this.$router.push({
                name: "sheet-details",
                params: {
                    id: sheetId
                }
            });
        }
    }
};
</script>
