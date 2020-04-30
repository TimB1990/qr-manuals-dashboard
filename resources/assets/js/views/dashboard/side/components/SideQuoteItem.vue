<template>
   <div class="side-quote-item">
      <div class="content">
         <div class="content__left">
            <span><strong>email:</strong> {{ quote_email }}</span>
            <span><strong>company:</strong> {{ quote_company }}</span>
         </div>
         <div class="content__right">
            <span>quotation #{{ quote_id }}</span>
            <span>{{ quote_status }} at {{ quote_timestamp }}</span>
         </div>
      </div>
      <div class="buttons">
         <button class="item-btn">Decline</button>
         <button class="item-btn">Accept</button>
      </div>
   </div>
</template>

<script>
export default {
  name: "sideQuoteItem",
  props: {
    quote_id: Number,
    quote_email: String,
    quote_company: String,
    quote_status: String,
    quote_timestamp: String
  }
};
</script>

<style scoped>
.side-quote-item {
  display: flex;
  flex-direction: column;
  border: 1px solid hsl(0, 0%, 60%);
  padding: 8px;
  margin-bottom: 14px;
  font-size: 14px;

  /*animation: blinkPending 1s ease-in;
  animation-iteration-count: infinite;
  backface-visibility: hidden;*/
}
.buttons {
  display: flex;
  padding: 0.5rem;
  justify-content: center;
}

.content {
  display: flex;
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
  /*border-radius: 6px;*/
  text-align: center;
  text-decoration: none;
  font-size: 14px;
  outline: none;
}
.item-btn:hover {
  border: 1px solid black;
  background-color: hsl(0, 0%, 96%);
}

.content__left, .content__right {
   display: flex;
   flex-direction: column;
}

.content__left{
   text-align: left;
}

.content__right{
   text-align: right;
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