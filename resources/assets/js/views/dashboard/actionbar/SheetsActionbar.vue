<template>
    <nav class="actionbar" role="actionbar" aria-label="actionbar">
        <div class="actionbar-start">
            <span>QR sheets</span>
        </div>
        <div class="actionbar-end">
            <button @click="createNewSheet" class="panel-btn">
                New Sheet
            </button>
            <button v-if="this.$route.name == 'qr-sheet-id' || this.$route.name == 'qr-sheet-new'" class="panel-btn" @click.prevent="clearSelected">
                Clear Selection
            </button>
            <span v-if="this.$route.name == 'qr-sheet-id' || this.$route.name == 'qr-sheet-new'">{{ selectedProductCount }}</span>
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
            this.$router.push({ name: "qr-sheet-new" });
        }
    },
    computed: {
        selectedProductCount() {
            return this.$store.getters.selectedProductCount;
        }
    }
};
</script>
