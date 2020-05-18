<template>
    <div v-if="quotes" class="side-menu-container">
        <div class="head">
            <span>Filter</span>
            <span>{{ quotes.count_all }}</span>
        </div>
        <div v-if="statuses.length" class="filter-panel">
            <div v-for="(status, index) in statuses" :key="index">
                <button
                    @click="fetchQuotes(statuses[index])"
                    class="filter-button"
                >
                    {{ statuses[index] }}
                    <span v-if="quotes.count_status">
                        <!-- error on startup ? count_status undefined -->
                        {{ quotes.count_status[statuses[index]] }}
                    </span>
                </button>
            </div>
        </div>

        <div class="head">
            <span>Quotations</span>
            <span>{{ currentItemStatus }}</span>
        </div>
        <div class="quotations-panel">
            <div v-if="quotes">
                <side-quote-item
                    v-for="quote in quotes.items"
                    :key="quote.id"
                    :quote_id="quote.quote_id"
                    :quote_articles="quote.articles"
                    :quote_amount="quote.amount"
                    :quote_email="quote.email"
                    :quote_company="quote.company"
                    :quote_status="quote.status"
                    :quote_created_at="quote.created_at"
                    :quote_updated_at="quote.updated_at"
                />
            </div>
            <div v-if="!quotes.items || !quotes.items.length">
                There are currently no items with status:
                {{ currentItemStatus }}
            </div>
        </div>
    </div>
</template>

<script>
import SideQuoteItem from "./components/SideQuoteItem";
import moment from "moment";
export default {
    name: "sideQuotations",
    components: { SideQuoteItem },
    created() {
        this.fetchQuotes("pending");
    },

    methods: {
        fetchQuotes(status) {
            this.$store
                .dispatch("fetchQuotes", {
                    status: status
                })
                .then((this.currentItemStatus = status));
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
            currentItemStatus: null
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

<style scoped>
.side-menu-container {
    background-color: white;
    padding: 12px;
    border-radius: 6px;
    box-shadow: 0 0.5em 0.5em -0.125em rgba(10, 10, 10, 0.1),
        0 0px 0 1px rgba(10, 10, 10, 0.02);
}

.head {
    display: flex;
    justify-content: space-between;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
    background-color: #cc0033;
    color: #fff;
}

.quotations-panel {
    padding: 1rem;
    /*border: 1px solid hsl(0, 0%, 80%);*/
}

.filter-panel {
    display: flex;
    flex-flow: row wrap;
    justify-content: space-between;
    margin-bottom: 0.75rem;
    padding: 1rem;
    /*border: 1px solid hsl(0, 0%, 80%);*/
}

.filter-button {
    display: flex;
    justify-content: space-between;
    outline: none;
    width: 7rem;
    background-color: transparent;
    border: 1px solid hsl(0, 0%, 60%);
    padding: 0.5rem;
    margin: 0.25rem;
}

.filter-button:hover {
    border: 1px solid black;
    background-color: hsl(0, 0%, 96%);
}

.filter-button > span {
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    border: 1px solid hsl(0, 0%, 76%);
    border-radius: 25%;
}
</style>
