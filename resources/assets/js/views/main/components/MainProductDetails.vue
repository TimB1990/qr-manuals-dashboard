<template>
  <div class="container">
    <h3>
      <strong>Product Details:</strong>
    </h3>

    <!-- <div>{{ productDetails }}</div> -->

    <table class="table is-fullwidth" v-if="productDetails">
      <tr v-for="detail in productDetails" :key="detail[0]">
        <td>{{ detail[0].replace('_', " ") }}</td>
        <td>{{ detail[1] }}</td>
      </tr>
    </table>

    <div v-else>
      <h2>no details present.</h2>
    </div>
  </div>
</template>

<script>
export default {
  name: "mainProductDetails",
  components: {},

  created() {
    this.fetchDetails();
  },

  watch: {
    $route(to, from) {
      this.fetchDetails();
    }
  },

  methods: {
    fetchDetails() {
      this.$store.dispatch("fetchDetails", {
        id: this.$route.params.id
      });
    }
  },

  computed: {
    productDetails() {
      if (this.$store.state.productDetails.data) {
        let data = this.$store.state.productDetails.data;
        return Object.entries(data);
      }
    },
    loading() {
      return this.$store.state.loadingStatus === "notloading";
    },
    error() {
      return this.$store.state.errors.length > 0;
    }
  }
};
</script>

