<template>
    <div class="content-root">
        <div class="feed">
            <div v-if="feeds && feeds.length">
                <feed-item
                    v-for="feed in feeds"
                    :key="feed.id"
                    :message="feed.message"
                    :ref_id="feed.reference_id"
                    :subject="'products'"
                    :updatedAt="feed.updated_at"
                />
            </div>
            <div v-else>
                <p>There are currently no updates to notify</p>
            </div>
        </div>
    </div>
</template>
<script>
import FeedItem from "./FeedItem";
export default {
    name: "productFeeds",
    components: { FeedItem },

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
        }
    }
};
</script>
