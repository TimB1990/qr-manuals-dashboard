<template>
    <div class="content-root">
        <div class="feed">
            <div v-if="feeds && feeds.length">
                <feed-item
                    v-for="feed in feeds"
                    :key="feed.id"
                    :message="feed.message"
                    :ref_id="feed.reference_id"
                    :subject="'quotations'"
                    :updatedAt="feed.updated_at"
                />

                <div v-if="!feeds || !feeds.length">
                    <p>There are currently no updates to notify</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FeedItem from "./FeedItem";

export default {
    name: "quoteFeeds",
    components: { FeedItem },
    created() {
        this.fetchFeed("quotes", 1);
    },
    methods: {
        fetchFeed(subject, page) {
            this.$store.dispatch("fetchFeedMessages", {
                subject: subject,
                page: page
            });
        }
    },
    computed: {
        feeds() {
            return this.$store.state.feedMessages.data;
        },

        feedsFull() {
            return this.$store.state.feedMessages;
        }
    }
};
</script>
