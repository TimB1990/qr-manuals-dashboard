<template>
    <div class="quote-item">
        <div class="item-header">
            <span>#{{ quote_id }}</span>
            <span>{{ this.momentAgo }}</span>
        </div>
        <div class="item-content">
            <span><b>email:</b> {{ quote_email }}</span>
            <span><b>company:</b> {{ quote_company }}</span>
            <span><b>created:</b> {{ this.createdAt }}</span>
            <span
                ><b>status:</b> {{ quote_status }} at {{ this.updatedAt }}</span
            >
        </div>
        <div class="buttons">
            <button
                v-if="quote_status == 'denied'"
                class="item-btn"
                @click="updateQuoteStatus('review')"
            >
                Review
            </button>
            <button
                v-if="quote_status == 'accepted' || quote_status == 'pending'"
                @click="updateQuoteStatus('denied')"
                class="item-btn"
            >
                Decline
            </button>
            <button
                v-if="quote_status == 'pending'"
                @click="updateQuoteStatus('accepted')"
                class="item-btn"
            >
                Accept
            </button>
            <button
                v-if="quote_status == 'accepted'"
                @click="addSpecification(quote_id)"
                class="item-btn"
            >
                Add Price Specification
            </button>
        </div>
        <div class="buttons">
            <button class="item-btn" @click="showDetails(quote_id)">Show Details</button>
        </div>
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

<style scoped>
.quote-item {
    display: flex;
    flex-direction: column;
    padding: 8px;
    border: 1px solid hsl(0, 0%, 92%);
    margin-bottom: 14px;
    font-size: 14px;
    box-shadow: 0 0.5em 0.5em -0.125em rgba(10, 10, 10, 0.1),
        0 0px 0 1px rgba(10, 10, 10, 0.02);

    /*animation: blinkPending 1s ease-in;
  animation-iteration-count: infinite;
  backface-visibility: hidden;*/
}

.quote-item:hover {
    border: 1px solid black;
}
.buttons {
    display: flex;
    align-items: stretch;
    padding: 0.5rem;
}

.item-content {
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    padding: 0.75rem;
}

.item-header {
    display: flex;
    font-weight: bold;
    justify-content: space-between;
}
.item-btn, .item-btn-details {
    display: inline-block;
    flex: 1;
    margin: 3px 3px 3px 3px;
    background-color: transparent;
    border: 1px solid hsl(0, 0%, 76%);
    padding: 6px 12px;
    text-align: center;
    text-decoration: none;
    font-size: 14px;
    outline: none;
}

.item-btn-details{
    background-color: rgb(204, 0, 51);
    color: white;
}

.item-btn:hover {
    border: 1px solid black;
    background-color: hsl(0, 0%, 96%);
}

.item-btn-details:hover{
    border: 1.3px solid black;
}

@keyframes blinkPending {
    0% {
        border: 1px solid hsl(0, 0%, 86%);
    }
    50% {
        border: 1.5px solid #cc0033;
    }
    100% {
        border: 1px solid hsl(0, 0%, 86%);
    }
}
</style>
