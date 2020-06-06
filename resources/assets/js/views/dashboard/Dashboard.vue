<template>
    <div id="root">
        <header class="header">
            <header-root></header-root>
            <router-view name="actionbar"></router-view>
        </header>
        <section class="side-and-main">
            <div v-if="productMenu" class="side">
                <router-view name="side"></router-view>
            </div>
            <div class="main">
                <router-view name="content"></router-view>
            </div>
        </section>
    </div>
</template>

<script>
import HeaderRoot from "./header/HeaderRoot";

export default {
    // some comment
    name: "dashboard",
    components: {
        HeaderRoot
    },

    computed: {
        productMenu() {
            return this.$store.state.productMenu;
        }
    }
};
</script>
