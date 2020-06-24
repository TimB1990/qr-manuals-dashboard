<template>
    <div class="feed-msg">
        <div class="feed-msg-header">
            <span>{{ momentAgo }}</span>
        </div>
        <div class="feed-msg-content">
            <span><b>Message:</b> {{ message }}</span>
            <button @click="gotoReferenced(subject,ref_id)" class="panel-btn">View content</button>
        </div>
    </div>
</template>
<script>
import moment from "moment";
export default {
    name: "feedItem",
    props: {
        message: String,
        subject: String,
        ref_id: Number,
        updatedAt: String
    },
    methods: {
      gotoReferenced(subject, ref_id){
        this.$router.push({
          path: `${subject}/${ref_id}/details`
        });

      }

    },
    computed: {
        momentAgo() {
            return moment.utc(this.updatedAt).fromNow();
        }

    }
};
</script>
