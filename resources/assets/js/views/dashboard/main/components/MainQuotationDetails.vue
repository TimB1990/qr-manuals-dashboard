<template>
    <div class="quotation-details-root">
        <div>
            <p>id: {{ this.$route.params.id }}</p>
            <table>
               <th>customer details</th>
               <tr v-for="detail in quoteCustomerDetails" :key="detail[0]">
                  <td>{{ detail[0] }}</td>
                  <td>{{ detail[1] }}</td>
               </tr>
            </table>
        </div>
    </div>
</template>
<script>
export default {
  name: "mainQuotationDetails",
  created(){
     this.fetchQuoteDetails(this.$route.params.id)
  },
  methods: {
     fetchQuoteDetails(quote_id){
        this.$store.dispatch("fetchQuoteDetails", {
           quote_id: quote_id
        })
     }
  },
  computed: {
     quoteDetailsAll(){
        return this.$store.state.quoteDetails;
     },
     quoteDetails(){
        const data = this.$store.state.quoteDetails.quote;
        return Object.entries(data);
     },

     quoteCustomerDetails(){
        const data = this.$store.state.quoteDetails.customer;
        console.log("customer data: ", data);
        return Object.entries(data);
     },

     quoteProductDetails(){
        // till now only one product per quote
        const data = this.$store.state.quoteDetails.products[0];
        return Object.entries(data); 
     }
  }
};
</script>

<style scoped>
.quotation-details-root {
  padding: 12px;
  /*border: 1px solid hsl(0, 0%, 80%);*/
  border-radius: 6px;
  box-shadow: 0 0.5em 1em -0.125em rgba(10, 10, 10, 0.1),
    0 0px 0 1px rgba(10, 10, 10, 0.02);
}
</style>
