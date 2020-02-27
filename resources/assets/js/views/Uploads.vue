<template>
  <div class="tile is-ancestor">
    <div class="tile is-parent">
      <productlist></productlist>
    </div>
    <div class="tile is-parent is-8 is-vertical">
      <article class="tile is-child box">
        <product-details></product-details>
      </article>
      <article class="tile is-child box">
        <upload></upload>
      </article>
    </div>
  </div>
</template>

<script>
import Upload from "../components/product/Upload";
import Productlist from "../components/product/Productlist";
import ProductDetails from "../components/product/ProductDetails";

export default {
  components: { Upload, Productlist, ProductDetails },
  data() {
    return {};
  }
};
</script>  