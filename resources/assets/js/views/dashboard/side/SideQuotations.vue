<template>
    <div class="content-root">
        <div v-if="!loading" class="menu-header">
            <span>Loading...</span>
            <span class="side-load"></span>
        </div>

        <!-- menu pagination -->
                <div class="page-count">
            <b>List:</b> {{ page }} of {{ quotes.pages }}
        </div>

        <!-- searchbar -->
        <div class="menu-header-2">
            <div class="search">
                <i class="fa fa-search" aria-hidden="true"></i>
                <input @input="updateQuoteFetch($event.target.value, 1)" type="text" :placeholder="'search ' +  quotesStatus + ' quotations'" />
            </div>
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
            <hr />
            <div class="panel">
                <button
                    @click="fetchQuotes(query, page - 1)"
                    class="panel-btn"
                    :disabled="page == 1"
                >
                    Previous
                </button>
                <button
                    @click="fetchQuotes(query, page + 1)"
                    class="panel-btn"
                    :disabled="page == quotes.pages"
                >
                    Next
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import SideQuoteItem from "./components/SideQuoteItem";
import SideMenuPaginator from "./components/SideMenuPaginator";
import moment from "moment";

export default {
    name: "sideQuotations",
    components: { SideQuoteItem, SideMenuPaginator },
    data() {
        return {
            page: 1,
            query: ""
        };
    },

    methods: {
        fetchQuotes(query, page) {
            this.query = query
            this.page = page;

            this.$store.dispatch("fetchQuotes", {
                query: query,
                page: page
            });
        },

        // search debounce
        updateQuoteFetch: _.debounce(function(query, page) {
            this.query = query
            this.fetchQuotes(query,page)
        }, 800)
    },

    computed: {
        quotes() {
            return this.$store.state.quotes;
            //if (data) return data;
        },
        loading() {
            return this.$store.state.loadingStatus === "notloading";
        },

        quotesStatus() {
            return this.$store.state.quotesStatus;
        }
    }
};
</script>
