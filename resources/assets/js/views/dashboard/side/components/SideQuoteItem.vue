<template>
    <div
        :class="{
            'side-item': true,
            active: quote_id == this.$route.params.id
        }"
    >
        <div class="item-header">
            <span>#{{ quote_id }}</span>
            <span>{{ momentAgo }}</span>
        </div>
        <ul>
            <li><b>email:</b> {{ quote_email }}</li>
            <li><b>company:</b> {{ quote_company }}</li>
            <li><b>created:</b> {{ this.createdAt }}</li>
            <li><b>status:</b> {{ quote_status }} at {{ this.updatedAt }}</li>
        </ul>
        <div class="panel">
            <button
                v-if="quote_status == 'denied' || quote_status == 'processed'"
                class="panel-btn"
                @click="updateQuoteStatus('review')"
            >
                Review
            </button>
            <button
                v-if="quote_status == 'accepted' || quote_status == 'pending'"
                @click="updateQuoteStatus('denied')"
                class="panel-btn"
                
            >
                Decline
            </button>
            <button
                v-if="quote_status == 'pending' || quote_status == 'review'"
                @click="updateQuoteStatus('accepted')"
                class="panel-btn"
                
            >
                Accept
            </button>
            <button
                v-if="quote_status == 'accepted'"
                @click="addSpecification(quote_id)"
                class="panel-btn"
                
            >
                Add Price Specification
            </button>
            <button v-if="quote_status == 'processed'" class="panel-btn">
                Convert To Order
            </button>
        </div>
        <button class="btn" @click="showDetails(quote_id)">
            Show Details
        </button>
    </div>
</template>

<script>
import moment from "moment";
export default {
    name: "sideQuoteItem",
    props: {
        quote_id: Number,
        quote_articles: Array,
        quote_amount: Number,
        quote_email: String,
        quote_company: String,
        quote_status: String,
        quote_created_at: String,
        quote_updated_at: String
    },
    methods: {
        showDetails(quote_id) {
            this.$router
                .replace({
                    name: "quotation_details",
                    params: {
                        id: quote_id
                    }
                })
                .catch(err => {});
        },

        addSpecification(quote_id) {
            this.$router.push({
                name: "quotation_specification",
                params: {
                    id: quote_id
                }
            });
        },

        updateQuoteStatus(status) {
            this.$store.dispatch("updateQuoteStatus", {
                quote_id: this.quote_id,
                status: status
            });
        }
    },
    computed: {
        momentAgo() {
            return moment(this.quote_updated_at).fromNow();
        },
        createdAt() {
            return moment(this.quote_created_at).format("DD-MM-YYYY, HH:mm");
        },
        updatedAt() {
            return moment(this.quote_updated_at).format("DD-MM-YYYY, HH:mm");
        }
    }
};
</script>
