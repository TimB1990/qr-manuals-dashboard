<template>
  <div class="tile is-ancestor">
    <div class="tile is-parent is-vertical">
      <productlist></productlist>
    </div>
    <div class="tile is-parent is-8 is-vertical">
      <product-details class="tile is-child box"></product-details>
      <button @click="toggleUpload" style="float:right;" class="button is-small">
        <span class="file-icon">
          <i class="fa fa-upload"></i>
        </span>
        Upload New Manual
      </button>
      <upload class="tile is-child box" v-if="openUpload" @close="toggleUpload"></upload>
    </div>
  </div>
</template>

<script>
import Productlist from "../components/product/Productlist";
import ProductDetails from "../components/product/ProductDetails";
import Upload from "../components/product/Upload";

export default {
  components: { Productlist, ProductDetails, Upload },
  data() {
    return {
      openUpload: false
    };
  },
  methods: {
    toggleUpload() {
      this.openUpload = !this.openUpload;
    }
  }
};
</script>  