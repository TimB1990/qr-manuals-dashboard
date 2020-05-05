<template>
   <div class="quote-item" @click="showDetails(quote_id)">
     <div class="item-header">
       <span>#{{ quote_id }}</span>
       <span>{{ this.momentAgo}}</span>
     </div>
      <div class="item-content">
        <span><b>email:</b> {{ quote_email }}</span>
        <span><b>company:</b> {{ quote_company }}</span>
        <span><b>created:</b> {{ this.createdAt }}</span>
        <span><b>status:</b> {{ quote_status }} at {{ this.updatedAt }}</span>
      </div>
      <div class="buttons">
         <button class="item-btn">Decline</button>
         <button class="item-btn">Accept</button>
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
    showDetails(quote_id){
      this.$router.replace({
        name: 'quotation_details',
        params: {
          id: quote_id
        }
      }).catch(err => {})
    }

  },
  computed: {
    momentAgo() {
      return moment(this.quote_updated_at).fromNow();
    },
    createdAt(){
      return moment(this.quote_created_at).format("DD-MM-YYYY, HH:mm");
    },
    updatedAt(){
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
  border: 1px solid hsl(0,0%,92%);
  margin-bottom: 14px;
  font-size: 14px;
    box-shadow: 0 0.5em 0.5em -0.125em rgba(10, 10, 10, 0.1),
    0 0px 0 1px rgba(10, 10, 10, 0.02);

  /*animation: blinkPending 1s ease-in;
  animation-iteration-count: infinite;
  backface-visibility: hidden;*/
}

.quote-item:hover {
  border: 1.0px solid black;

}
.buttons {
  display: flex;
  padding: 0.5rem;
  justify-content: center;
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
.item-btn {
  display: inline-block;
  margin: 3px 3px 3px 3px;
  width: 6rem;
  height: 2rem;
  background-color: transparent;
  border: 1px solid hsl(0, 0%, 76%);
  padding: 6px;
  text-align: center;
  text-decoration: none;
  font-size: 14px;
  outline: none;
}
.item-btn:hover {
  border: 1px solid black;
  background-color: hsl(0, 0%, 96%);
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