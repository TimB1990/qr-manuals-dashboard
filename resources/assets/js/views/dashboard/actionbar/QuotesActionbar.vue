<template>
    <nav
        v-if="quotes"
        class="actionbar"
        role="actionbar"
        aria-label="actionbar"
    >
        <i @click="toggleSide" class="fas fa-bars"></i>
        <div class="panel" v-if="statuses.length">
            <div v-for="(status, index) in statuses" :key="index">
                <button
                    @click="fetchQuotes(statuses[index])"
                    :class="{
                        'panel-btn': true,
                        active: statuses[index] == currentStatus
                    }"
                >
                    {{ statuses[index] }}
                    <span v-if="quotes.count_status">
                        {{ quotes.count_status[statuses[index]] }}
                    </span>
                </button>
            </div>
        </div>
        <span>Total: {{ quotes.count_all }}</span>
    </nav>
</template>

<script>
export default {
    name: "quotesActionBar",
    created() {
        this.fetchQuotes("pending");
    },

    methods: {
        fetchQuotes(status) {
            this.$store
                .dispatch("fetchQuotes", {
                    status: status
                })
                .then((this.currentStatus = status));
        },

        toggleSide() {
            this.$store.dispatch("toggleSideMenu", {
                show: null
            });
        }
    },
    data() {
        return {
            statuses: [
                "pending",
                "accepted",
                "processed",
                "approved",
                "denied",
                "review"
            ],
            currentStatus: ""
        };
    },

    computed: {
        quotes() {
            let data = this.$store.state.quotes;
            if (data) return data;
        }
    }
};
</script>
