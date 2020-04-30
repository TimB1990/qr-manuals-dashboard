<template>
   <div class="side-menu-container">
      <p>Filter Status</p>
      <div class="filter-panel">
         <button v-for="(status,index) in statuses" :key="index">
            {{ statuses[index]}}
            <span>0</span>
         </button>
      </div>
      
      <p>Quotations</p>
      <div class="quotations-panel">
       <side-quote-item
         :quote_id="1"
         :quote_email="'test@mail.com'"
         :quote_company="'test company'"
         :quote_status="'pending'"
         :quote_timestamp="now"
      />
             <side-quote-item
         :quote_id="2520"
         :quote_email="'pgraaf@bootmansbv.nl'"
         :quote_company="'Bootmans B.V.'"
         :quote_status="'pending'"
         :quote_timestamp="now"
      />
      </div>
   </div>
</template>

<script>
import SideQuoteItem from "./components/SideQuoteItem";
import moment from "moment";
export default {
  name: "sideQuotations",
  components: { SideQuoteItem },
  data() {
    return {
      statuses: [
        "pending",
        "accepted",
        "processed",
        "approved",
        "denied",
        "to review"
      ]
    };
  },
  computed: {
    now() {
      return moment().format("DD-MM-YYYY HH:mm");
    }
  }
};
</script>

<style scoped>
.side-menu-container {
  background-color: white;
  padding: 12px;
  border-radius: 6px;
  box-shadow: 0 0.5em 0.5em -0.125em rgba(10, 10, 10, 0.1), 0 0px 0 1px rgba(10, 10, 10, 0.02);
}

.side-menu-container > p {
   padding-left: 0.5rem;
   padding-top: 0.25rem;
   padding-bottom: 0.25rem;
   background-color: #CC0033;
   color: #fff
}

.quotations-panel{
   padding: 1rem;
   /*border: 1px solid hsl(0, 0%, 80%);*/
}

.filter-panel{
   display: flex;
   flex-flow: row wrap;
   justify-content: space-between;
   margin-bottom: 0.75rem;
   padding: 1rem;
   /*border: 1px solid hsl(0, 0%, 80%);*/
}

.filter-panel > button {
   display: flex;
   justify-content: space-between;
   outline: none;
   width: 7rem;
   background-color: transparent;
   border: 1px solid hsl(0, 0%, 60%);
   padding: 0.5rem;
   margin: 0.25rem;

}

.filter-panel > button:hover{
   border: 1px solid black;
   background-color: hsl(0, 0%, 96%);
}

.filter-panel > button > span {
   padding-left: 0.5rem;
   padding-right: 0.5rem;
   border: 1px solid hsl(0, 0%, 76%);
   border-radius: 25%;
}
</style>