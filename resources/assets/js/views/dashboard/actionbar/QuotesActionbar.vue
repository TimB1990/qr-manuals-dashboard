<template>
    <nav
        class="actionbar"
        role="actionbar"
        aria-label="actionbar"
    >
        <div class="panel" v-if="statuses.length">
            <div v-for="(status, index) in statuses" :key="index">
                <button
                    @click="setQuotesStatus(statuses[index])"
                    :class="{
                        'panel-btn': true,
                        active: statuses[index] == quotesStatus
                    }"
                >
                    {{ statuses[index] }}
                </button>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "quotesActionBar",
    created() {
        this.setQuotesStatus("pending");
    },

    methods: {
        setQuotesStatus(status) {
            this.$store.dispatch("setQuotesStatus", {
                status: status
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
        quotesStatus() {
            return this.$store.state.quotesStatus;
        }
    }
};
</script>
