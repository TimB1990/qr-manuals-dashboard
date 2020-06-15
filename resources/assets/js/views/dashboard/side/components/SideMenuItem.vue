<template>
    <div
        :class="{ 'side-item': true, 'item-selected': this.selected }"
        ref="item"
    >
        <span>{{ selectionMode }}</span>
        <ul @click="fetchDetails(product_id)">
            <li>
                <b>{{ product_name }}</b>
            </li>
            <li>#{{ product_artnr }}</li>
            <li>kind: {{ product_kind }}</li>
            <li>stock: {{ product_stock }}</li>
            <li>&euro; {{ product_unit_price }} per unit</li>
        </ul>
        <nav v-if="categories">
            <span v-for="(category, i) of categories" :key="i">
                <b>{{ category.name }} | </b>
            </span>
            <span
                v-if="
                    this.$route.name == 'sheet-new' ||
                        this.$route.name == 'sheet-edit'
                "
            >
                <i
                    @click="
                        addRemoveSelected(
                            selectionMode,
                            product_id,
                            product_name,
                            product_artnr,
                            product_kind
                        )
                    "
                    :class="{
                        fa: true,
                        'fa-check': true,
                        'item-selected': this.selected
                    }"
                ></i>
            </span>
        </nav>
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

            if (this.$store.getters.productIsSelected(id)) {
                // item is selected
                if ((this.selectionMode = "single")) {
                    this.$store.dispatch("clearSelected");
                    this.$store.dispatch("setItemCopies", {
                        value: 0
                    })
                } else {
                    this.$store.dispatch("removeSelectedProduct", { id: id });
                }
            } else {

                // item not selected
                if (this.selectionMode == "single") {
                    this.$store.dispatch("clearSelected");
                }

                this.$store.dispatch("addSelectedProduct", { data: data });
                this.$store.dispatch("setItemCopies", {
                    value: 1
                })
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
