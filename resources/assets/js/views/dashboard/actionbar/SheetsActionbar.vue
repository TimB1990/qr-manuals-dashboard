<template>
    <nav class="actionbar" role="actionbar" aria-label="actionbar">
        <div class="actionbar-start">
            <span>QR sheets</span>
        </div>
        <div class="actionbar-end">
            <button @click="createNewSheet" class="panel-btn">
                New Sheet
            </button>
            <button v-if="this.$route.name == 'sheet-edit' || this.$route.name == 'sheet-new'" class="panel-btn" @click.prevent="clearSelected">
                Clear Selection
            </button>
            <span v-if="this.$route.name == 'sheet-edit' || this.$route.name == 'sheet-new'">{{ selectedProductCount }}</span>
        </div>
    </nav>
</template>

<script>
export default {
    name: "sheetsActionbar",
    methods: {
        clearSelected() {
            this.$store.dispatch("clearSelected");
        },
        createNewSheet() {
            // clear selected in anyhow
            this.$store.dispatch("clearSelected");

            // go to new sheet route
            this.$router.push({ name: "sheet-new" });
        }
    },
    computed: {
        selectedProductCount() {
            return this.$store.getters.selectedProductCount;
        }
    }
};
</script>
