<template>
  <div class="container">
    <!-- <div>{{ productDetails }}</div> -->
    <table class="table is-fullwidth is-bordered" v-if="productDetails">
      <tr v-for="detail in productDetails" :key="detail[0]">
        <td>{{ detail[0] }}</td>
        <td>{{ detail[1] }}</td>
      </tr>
    </table>

    <div v-else>
      <h2>no details present.</h2>
    </div>

    <table class="table is-fullwidth is-bordered">

      <thead>
        <tr>
          <th>id</th>
          <th>artnr</th>
          <th>filename</th>
          <th>download</th>
          <th>delete</th>
        </tr>
      </thead>

      <tbody v-if="productManuals">
        <tr v-for="manual in productManuals" :key="manual.id">
          <td>{{manual.id}}</td>
          <td>{{manual.artnr}}</td>
          <td>{{manual.file_name}}</td>
          <td>
            <a :href="manual.file_url" class="button is-small">Download</a>
          </td>
          <td>
            <a class="button is-small" @click="deleteManual(manual.id)">x</a>
          </td>
        </tr>
      </tbody>

      <tbody v-if="productManuals.length < 1">
        <tr>
          <td colspan="5">This product has no manuals assigned...</td>
        </tr>
      </tbody>
      
    </table>

    <p v-if="error" style="color:red;">error: {{ error }}</p>

    <main-product-manuals-upload :id="this.$route.params.id" />
  </div>
</template>

<script>
import MainProductManualsUpload from "./MainProductManualsUpload";
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

    deleteManual(manual_id) {
      this.$store.dispatch("deleteManual", {
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

