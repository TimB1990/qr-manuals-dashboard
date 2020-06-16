<template>
    <div
        :class="{ 'side-item': true, 'item-selected': this.selected }"
        ref="item"
    >
        <ul @click="fetchDetails(product_id)">
            <li>
                <b>{{ product_name }}</b>
            </li>
            <li>#{{ product_artnr }}</li>
            <li>kind: {{ product_kind }}</li>
            <li>stock: {{ product_stock }}</li>
            <li>&euro; {{ product_unit_price }} per unit</li>
        </ul>

        <div class="side-item-footer">
            <nav v-if="categories">
                <span v-for="(category, i) of categories" :key="i">
                    <b>{{ category.name }} | </b>
                </span>
            </nav>
            <input type="number" value="0" />
        </div>
    </div>
</template>

<script>
export default {
    name: "sideMenuItem",
    props: [
        "product_id",
        "product_artnr",
        "product_name",
        "product_kind",
        "product_stock",
        "product_unit_price",
        "categories"
    ],

    methods: {
        fetchDetails(id) {
            console.log("navigate to details of:", id);
            this.$router.replace({
                name: "product_details",
                params: {
                    id: id
                }
            });
        },

        addRemoveSelected(selectionMode, id, name, artnr, kind) {
            // check if id is included in productIsSelected getters from store
            let data = {
                id: id,
                artnr: artnr,
                kind: kind
            };

            var selected = this.$store.getters.productIsSelected(id);

            if (selected && this.selectionMode == "single") {
                // clear selection
                this.$store.dispatch("clearSelected");

                // set item copies to zero
                this.$store.dispatch("setItemCopies", { value: 0 });
            }

            if (selected && this.selectionMode == "multiple") {
                // remove selected from selection
                this.$store.dispatch("removeSelectedProduct", { id: id });
            }

            if (!selected && this.selectionMode == "single") {
                // add selected product
                this.$store.dispatch("addSelectedProduct", { data: data });
                // set item copies to one
                this.$store.dispatch("setItemCopies", { value: 1 });
            }

            if (!selected && this.selectionMode == "multi") {
                // just add to selection
                this.$store.dispatch("addSelectedProduct", { data: data });
            }
        }
    },

    computed: {
        selected() {
            return this.$store.getters.productIsSelected(this.product_id);
        },

        selectionMode() {
            return this.$store.state.selectionMode;
        }
    }
};
</script>
