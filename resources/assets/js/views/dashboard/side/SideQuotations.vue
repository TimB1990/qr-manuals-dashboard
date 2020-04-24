<template>
   <div class="side-menu-container">
      <side-quote-item
         :quote_id="1"
         :quote_email="'test@mail.com'"
         :quote_company="'test company'"
         :quote_status="'pending'"
         :quote_timestamp="now"
      />
   </div>
</template>

<script>
import SideQuoteItem from './components/SideQuoteItem'
import moment from 'moment'
export default {
   name: "sideQuotations",
   components: { SideQuoteItem },
   computed: {
      now(){
         return moment();
      }
   }
}
</script>

<style scoped>
.side-menu-container {
  background-color: white;
  padding: 12px;
  border-radius: 6px;
  box-shadow: 0 0.5em 1em -0.125em rgba(10, 10, 10, 0.1), 0 0px 0 1px rgba(10, 10, 10, 0.02);
}
</style>