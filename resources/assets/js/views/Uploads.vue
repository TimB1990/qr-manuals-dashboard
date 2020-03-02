<template>
  <div class="tile is-ancestor">
    <div class="tile is-parent is-vertical">
      <productlist></productlist>
    </div>
    <div class="tile is-parent is-8 is-vertical">
      <product-details class="tile is-child box"></product-details>
    </div>
  </div>
</template>

<script>
import Productlist from "../components/product/Productlist";
import ProductDetails from "../components/product/ProductDetails";
import Upload from "../components/product/Upload";

export default {
  components: { Productlist, ProductDetails, Upload }
};
</script>  