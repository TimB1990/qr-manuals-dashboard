<template>
  <div class="content-root">
    <table class="content-table">
      <thead>
        <tr>
          <td colspan="2">Product Details</td>
        </tr>
      </thead>
      <tbody v-if="productDetails">
        <tr v-for="detail in productDetails" :key="detail[0]">
          <td>{{ detail[0] }}</td>
          <td>{{ detail[1] }}</td>
        </tr>
      </tbody>
      <tbody v-else>
        <tr>
          <td colspan="2">This product has no details assigned...</td>
        </tr>
      </tbody>
    </table>

    <table class="content-table">
      <thead>
        <tr>
          <td colspan="4">Download Manual</td>
        </tr>
      </thead>

      <tbody v-if="this.productManuals && this.productManuals.length > 0">
        <tr v-for="manual in this.productManuals" :key="manual.id">
          <td>{{manual.artnr}}</td>
          <td>{{manual.file_name}}</td>
          <td align="center">
            <a :href="manual.file_url"><i class="fas fa-file-download"></i></a>
          </td>
          <td align="center">
            <a><i @click="deleteManual(manual.id)" class="fas fa-trash"></i></a>
          </td>
        </tr>
      </tbody>

      <tbody v-else>
        <tr>
          <td colspan="5">This product has no manuals assigned...</td>
        </tr>
      </tbody>
    </table>

    <p v-if="error" style="color:red;">error: {{ error }}</p>
    <main-product-manuals-upload :id="parseInt(this.$route.params.id)" />
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
        return this.$store.state.productManuals.data;
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

