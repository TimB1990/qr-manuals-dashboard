<template>
  <nav class="actionbar" role="actionbar" aria-label="actionbar">
    <div class="actionbar-start">
      <button @click="linkToProducts" class="btn">
        Products
      </button>
      <button  @click="linkToQuotations" class="btn">
        Quotations
      </button>
    </div>
    <div class="actionbar-end">
      <button @click="linkToSheetConfiguration" class="btn">QR sheet</button>
      <button class="btn" @click.prevent="clearSelected">Clear</button>
      <span>{{ selectedProductCount }}</span>
    </div>
  </nav>
</template>

<script>
export default {
  name: "headerActionbar",
  components: {},
  data() {
    return {
      qrAmount: 1
    };
  },
  methods: {
    clearSelected() {
      this.$store.dispatch("clearSelected");
    },

    linkToSheetConfiguration() {
      this.$router.push({
        name: "qr-config-panel"
      });
    },
    linkToQuotations(){
      this.$router.push({
        name: "quotations"
      })
    },
    linkToProducts(){
      this.$router.push({
        name: "products"
      })
    }
  },

  computed: {
    selectedProductCount() {
      return this.$store.getters.selectedProductCount;
    },
    selectedProducts() {
      return this.$store.state.selectedProducts;
    }
  }
};
</script>
