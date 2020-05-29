<template>
    <nav class="actionbar" role="actionbar" aria-label="actionbar">
        <div class="actionbar-start">
            <span>QR sheets</span>
        </div>
        <div class="actionbar-end">
            <button class="panel-btn" @click="gotoSheetManager">Import Sheet...</button>
        </div>
    </nav>
</template>

<script>
export default {
    name: "sheetsActionbar",
    methods: {
        gotoSheetManager() {
            this.$router.push({ name: "sheet_manager" });
        }
    }
};
</script>
