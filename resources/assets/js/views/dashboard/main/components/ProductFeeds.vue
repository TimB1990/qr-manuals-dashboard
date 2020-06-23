<template>
    <div class="content-root">
      <div v-if="feeds && feeds.length">
              <feed-item v-for="feed in feeds" :key="feed.id" :message="feed.message" :updatedAt="feed.updated_at" />
      </div>
      <div v-else>
        <p>There are currently no updates</p>
      </div>
    </div>
</template>
<script>
import FeedItem from "./FeedItem"
export default {
    name: "productFeeds",
    components: { FeedItem },
    created() {
        this.fetchFeed("manuals");
    },
    methods: {
        fetchFeed(subject) {
            this.$store.dispatch("fetchFeedMessages", {
                subject: subject
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
