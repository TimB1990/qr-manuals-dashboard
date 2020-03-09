<template>
  <div class="container">
    <h3>
      <strong>Product Details:</strong>
    </h3>

    <!-- <div>{{ productDetails }}</div> -->

    <table class="table is-fullwidth" v-if="productDetails">
      <tr v-for="detail in productDetails" :key="detail[0]">
        <td>{{ detail[0] }}</td>
        <td>{{ detail[1] }}</td>
      </tr>
    </table>

    <div v-else>
      <h2>no details present.</h2>
    </div>

    <p>
      <strong>Product Manuals</strong>
    </p>
    <table class="table is-fullwidth" v-if="productManuals">
      <tr>
        <th>manual id</th>
        <th>product id</th>
        <th>file name</th>
        <!-- <th>file path</th> -->
        <th>download</th>
        <th>delete</th>
      </tr>
      <tr v-for="manual in productManuals" :key="manual.id">
        <td v-text="manual.id"></td>
        <td v-text="manual.product_id"></td>
        <td v-text="manual.file_name"></td>
        <!-- <td v-text="manual.file_path"></td> -->
        <td>
          <a :href="manual.file_url" class="button">Download</a>
        </td>
        <td><a class="button" @click="deleteManual(manual.id)">x</a></td>
      </tr>
    </table>

    <div v-else>
      <p>No manuals present...</p>
    </div>

    <p v-if="error" style="color:red;">error: {{ error }}</p>

    <main-product-manuals-upload :id="this.$route.params.id"/>

  </div>
</template>

<script>
import MainProductManualsUpload from './MainProductManualsUpload';
export default {
  name: "mainProductDetails",
  components: { MainProductManualsUpload },

  created() {
    this.fetchDetails();
    this.fetchManuals();
  },

  watch: {
    $route(to, from) {
      this.fetchDetails();
      this.fetchManuals();
    }
  },

  methods: {
    fetchDetails() {
      this.$store.dispatch("fetchDetails", {
        id: this.$route.params.id
      });
    },

    fetchManuals() {
      this.$store.dispatch("fetchManuals", {
        id: this.$route.params.id
      });
    },

    deleteManual(manual_id){
      this.$store.dispatch('deleteManual', {
        id: this.$route.params.id,
        manual_id: manual_id
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
    productManuals() {
      if (this.$store.state.productManuals.data) {
        let data = this.$store.state.productManuals.data;
        return data;
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

