<template>
    <div class="quotation-details-root">
                  <table>
              <tr>
                <th colspan="2">Customer Details</th>
              </tr>
               <tr v-for="detail in quoteCustomerDetails" :key="detail[0]">
                  <td>{{ detail[0] }}</td>
                  <td>{{ detail[1] }}</td>
               </tr>
            </table>

          <table>
            <tr>
              <th colspan="2">Quotation Product Details</th>
            </tr>
            <tr v-for="detail in quoteProductDetailsEntries" :key="detail[0]">
              <td>{{ detail[0]}}</td>
              <td v-if="detail[0] == 'unit_price'">&euro; {{detail[1]}}</td>
              <td v-else>{{ detail[1]}}</td>
            </tr>
          </table>
            <table>
              <tr><th colspan="2">Quotation</th></tr>
              <tr>
                <td>Amount Of Product</td>
                <td>{{ quoteDetails.amount }}</td>
              </tr>
              <tr>
                <td>Total EUR</td>
                <td>&euro; {{ this.quoteTotalPrice  }}</td>
              </tr>
            </table>
        </div>
</template>
<script>
export default {
  name: "mainQuotationDetails",
  created() {
    this.fetchQuoteDetails(this.$route.params.id);
  },

  watch: {
    $route(to, from) {
      this.fetchQuoteDetails(this.$route.params.id);
    }
  },

  methods: {
    fetchQuoteDetails(quote_id) {
      this.$store.dispatch("fetchQuoteDetails", {
        quote_id: quote_id
      });
    }
  },
  computed: {
    quoteDetails() {
      return this.$store.getters.getQuoteDetails;
      // return Object.entries(data);
    },

    quoteCustomerDetails() {
      const data = this.$store.getters.getQuoteCustomerDetails;
      return Object.entries(data);
    },

    quoteProductDetailsEntries() {
      // till now only one product per quote
      const data = this.$store.getters.getQuoteProductDetails;
      return Object.entries(data);
    },

    quoteTotalPrice() {
      const quoteProductDetails = this.$store.getters.getQuoteProductDetails;
      let unitPrice = parseFloat(quoteProductDetails.unit_price);
      const quoteDetails = this.$store.getters.getQuoteDetails;
      let amount = quoteDetails.amount;
      let sum = unitPrice * amount;
      return sum.toFixed(2);
    }
  }
};
</script>

<style scoped>
.quotation-details-root {
  padding: 0.25rem;
  border-radius: 6px;
  box-shadow: 0 0.5em 1em -0.125em rgba(10, 10, 10, 0.1),
    0 0px 0 1px rgba(10, 10, 10, 0.02);
}

table {
  width: 100%;
  padding: 0.75rem;
}

table > tr > td {
  width: 50%;
  padding: 0.3rem;
  /*border-bottom: 1px solid hsl(0, 0%, 80%);*/
  border: 1px solid hsl(0, 0%, 80%);
}

th {
  padding: 0.5rem;
  background-color: rgb(204, 0, 51);
  color: white;
  font-weight: normal;
}
</style>
