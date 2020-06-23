<template>
  <div class="feed">
    <p class="feed-header">{{ momentAgo }}</p>
    <p class="feed-content">{{ message}}</p>
  </div>
</template>
<script>
import moment from "moment";
export default {
  name: "feedItem",
  props: {
    message: String,
    updatedAt: String
  },
  computed: {
    momentAgo(){
      return moment(this.updatedAt).fromNow();
    }
  }
}
</script>