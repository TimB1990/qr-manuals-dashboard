<template>
  <div>
    <strong>QR configuration panel</strong>
    <em>toggle one or more products to generate QR-codes on sheet</em>

    <table class="table">
        <tr v-for="selected in selectedProducts" :key="selected.id">
            <td v-text="selected.artnr"></td>
            <td>options</td>
        </tr>
    </table>

    <div class="sticker-sheet">
      <div class="sticker-sheet-margin-box">
        <main-qr-item
          v-for="selected in selectedProducts"
          :key="selected.id"
          :artnr="selected.artnr"
          :kind="selected.kind"
        ></main-qr-item>
      </div>
    </div>
  </div>
</template>

<script>
import MainQrItem from "./MainQrItem";
export default {
  name: "mainQrConfigPanel",
  components: { MainQrItem },
  computed: {
    selectedProducts() {
      return this.$store.state.selectedProducts;
    }
  }
};
</script>

<style>
.sticker-sheet {
  border: 1px solid blue;
  width: 210mm;
  height: 297mm;
  padding: 12.5mm;
}

.sticker-sheet-margin-box {
  display: flex;
  flex-wrap: wrap;
  align-content: flex-start;
  border: 1px solid gray;
  width: 100%;
  height: 100%;
}
</style>
