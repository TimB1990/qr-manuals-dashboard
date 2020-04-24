<template>
   <div class="side-quote-item">
      <ul>
         <li>{{ quote_id }}</li>
         <li>{{ quote_email }}</li>
         <li>{{ quote_company }}</li>
         <li>{{ quote_status }}</li>
         <li>{{ quote_timestamp }}</li>
      </ul>
      <div class="buttons">
         <button class="item-btn">Accept</button>
         <button class="item-btn">Decline</button>
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
      quote_timestamp: Object
   }
}
</script>

<style scoped>
.side-quote-item {
  display: flex;
  flex-direction: column;
  border: 1px solid hsl(0, 0%, 86%);
  padding: 8px;
  margin-bottom: 14px;
  font-size:14px;
}
.buttons{
   display: flex;
   padding: 0.5rem;
   justify-content: center;

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
}
</style>