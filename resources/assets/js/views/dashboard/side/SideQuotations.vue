<template>
    <div class="content-root">

        <div class="menu-header">
            <span>Quotations</span>
        </div>
        <div>
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
                There are currently no items pending or with this status
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
    computed: {
        quotes() {
            let data = this.$store.state.quotes;
            if (data) return data;
        }
    }
};
</script>
