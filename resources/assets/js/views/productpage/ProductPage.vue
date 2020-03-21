<template>
  <div class="container base">
    <div class="page-header">
      <img id="logo" src="/img/EXALTO-TG-logo-WEB.png" />
    </div>

    <div class="page-content">
      <scanner v-if="!this.product.length"></scanner>
      <view-panel v-else :product="this.product"></view-panel>
    </div>

    <div class="page-footer">
      <button v-if="this.product.length" @click="emptyProduct">Scan a product</button>
    </div>
  </div>
</template>

<script>
import Scanner from "./components/Scanner";
import ViewPanel from "./components/ViewPanel";

export default {
  name: "productpage",
  components: { Scanner, ViewPanel },

  methods: {
    emptyProduct(){
      this.$store.dispatch("emptyProduct",{
        id: this.product[0].id
      });
    }
  },

  computed: {
    product() {
      return this.$store.state.product;
    }
  }
};
</script>

<style>
.base {
  background-color: hsl(0, 0%, 96%);
  padding: 18px;
}

.page-header {
  margin-top: 18px;
  margin-bottom: 24px;
}

.page-content {
  margin-bottom: 48px;
}

.page-footer {
  display: flex;
  justify-content: space-evenly;
}

.page-footer > button {
  color: hsl(0, 0%, 40%);
  background-color: transparent;
  border-radius: 6px;
  font-size: 18px;
  padding-top: 10px;
  padding-bottom: 10px;
  padding-left: 24px;
  padding-right: 24px;
  cursor: pointer;
  border: 1px solid hsl(0, 0%, 40%);
  display: inline;
}
</style>