<template>
    <nav class="actionbar" role="actionbar" aria-label="actionbar">
        <div class="actionbar-start">
            <span>QR sheets</span>
        </div>
        <div class="actionbar-end">
            <button class="panel-btn" @click="gotoSheetManager">
                Import Sheet...
            </button>
            <button class="btn" @click.prevent="clearSelected">
                Clear Selection
            </button>
            <span>{{ selectedProductCount }}</span>
        </div>
    </nav>
</template>

<script>
export default {
    name: "sheetsActionbar",
    methods: {
        gotoSheetManager() {
            this.$router.push({ name: "sheet_manager" });
        },
        clearSelected() {
            this.$store.dispatch("clearSelected");
        }
    },
    computed: {
        selectedProductCount() {
            return this.$store.getters.selectedProductCount;
        }
    }
};
</script>
