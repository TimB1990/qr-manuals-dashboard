<template>
    <div
        :class="{'side-item': true, 'active': false }"
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
            <input
                v-if="
                    this.$route.name == 'sheet-new' ||
                        this.$route.name == 'sheet-edit'
                "
                @input="
                    addSelectedProduct(
                        $event.target.value,
                        product_id,
                        product_artnr,
                        product_kind
                    )
                "
                type="number"
                value="0"
            />
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

    data(){
        return {
            selectedProductID: null
        }
    },

    methods: {
        fetchDetails(id) {
            this.$router.replace({
                name: "product_details",
                params: {
                    id: id
                }
            });
        },

        // refactored
        addSelectedProduct(count, id, artnr, kind) {
            let data = [];

            for (let i = 0; i < count; i++) {
                data = [
                    ...data,
                    {
                        id: id,
                        artnr: artnr,
                        kind: kind
                    }
                ];
            }

            this.$store.dispatch("removeSelectedProduct", { id: id });
            this.$store.dispatch("addSelectedProduct", { data: data });
        }
    },

    computed: {

        selectionMode() {
            return this.$store.state.selectionMode;
        }
    }
};
</script>
