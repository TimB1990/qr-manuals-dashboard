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
                    {{ statuses[index] }} {{ quotes.count_status[statuses[index]]}} 
                </button>
            </div>
        </div>
        <span><b>Total:</b> {{ quotes.count_all}}</span>
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
                status: status,
                page: 1,
                query: ""
            });
        }
    },
    data() {
        return {
            currentStatus: ""
        };
    },

    computed: {
        statuses(){
            return [
                "pending",
                "accepted",
                "processed",
                "approved",
                "denied",
                "review"
            ]
        },
        quotesStatus() {
            return this.$store.state.quotesStatus;
        },
        quotes(){
            return this.$store.state.quotes
        }
    }
};
</script>
