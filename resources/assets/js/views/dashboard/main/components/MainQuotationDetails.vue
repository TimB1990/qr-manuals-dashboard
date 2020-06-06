<template>
    <div v-if="quoteCustomerDetails" class="content-root">
        <table class="content-table">
            <thead>
                <tr>
                    <td colspan="2">Customer Details</td>
                </tr>
            </thead>
            <tr v-for="detail in quoteCustomerDetails" :key="detail[0]">
                <td>{{ detail[0] }}</td>
                <td>{{ detail[1] }}</td>
            </tr>
        </table>

        <table class="content-table">
            <thead>
                <tr>
                    <td colspan="2">Quotation Product Details</td>
                </tr>
            </thead>

            <tr v-for="detail in quoteProductDetailsEntries" :key="detail[0]">
                <td>{{ detail[0] }}</td>
                <td v-if="detail[0] == 'unit_price'">&euro; {{ detail[1] }}</td>
                <td v-else>{{ detail[1] }}</td>
            </tr>
        </table>

        <table class="content-table">
            <thead>
                <tr>
                    <td colspan="2">Quotation</td>
                </tr>
            </thead>

            <tr>
                <td>Amount</td>
                <td>{{ quoteDetails.amount }}</td>
            </tr>
            <tr>
                <td>Total</td>
                <td>&euro; {{ this.quoteTotalPrice }}</td>
            </tr>
        </table>
    </div>
</template>
<script>
export default {
    name: "mainQuotationDetails",
    created() {
        this.fetchQuoteDetails(this.$route.params.id);
    },

    watch: {
        $route(to, from) {
            this.fetchQuoteDetails(this.$route.params.id);
        }
    },

    methods: {
        fetchQuoteDetails(quote_id) {
            this.$store.dispatch("fetchQuoteDetails", {
                quote_id: quote_id
            });
        }
    },
    computed: {
        quoteDetails() {
            return this.$store.getters.getQuoteDetails;
            // return Object.entries(data);
        },

        quoteCustomerDetails() {
            const data = this.$store.getters.getQuoteCustomerDetails;
            if (data) return Object.entries(data);
        },

        quoteProductDetailsEntries() {
            // till now only one product per quote
            const data = this.$store.getters.getQuoteProductDetails;
            if (data) return Object.entries(data);
        },

        quoteTotalPrice() {
            const quoteProductDetails = this.$store.getters
                .getQuoteProductDetails;
            let unitPrice = parseFloat(quoteProductDetails.unit_price);
            const quoteDetails = this.$store.getters.getQuoteDetails;
            let amount = quoteDetails.amount;
            let sum = unitPrice * amount;
            return sum.toFixed(2);
        }
    }
};
</script>
