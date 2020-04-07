<template>
  <nav class="actionbar" role="actionbar" aria-label="actionbar">
    <div class="actionbar-start">
      <!-- <span>QR-Codes / Product:</span>
      <input class="action-input" type="number" value="1" onfocus="this.value=''" min="1" max="99" v-model="qrAmount" />-->
      <button @click="linkToSheetConfiguration" class="action-btn">
        Generate Sheet
        <!-- <i class="fa fa-qrcode"></i> -->
      </button>
    </div>
    <div class="actionbar-end">
      <button class="action-btn" @click.prevent="clearSelected">Clear Selection</button>
      <button class="tag-selected">{{ selectedProductCount }}</button>
    </div>
  </nav>
</template>

<script>
export default {
  name: "headerActionbar",
  components: {},
  data(){
    return {
      qrAmount: 1
    }
  },
  methods: {
    clearSelected() {
      this.$store.dispatch("clearSelected");
    },

    linkToSheetConfiguration(){
      this.$router.push({
        name: 'qr-config-panel',
      });
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

<style>
.actionbar {
  display: flex;
  justify-content: space-between;
  border-top-color: white;
  padding-top: 8px;
  padding-bottom: 8px;
  padding-left: 12px;
  padding-right: 12px;
  box-shadow: 0 0.5em 1em -0.125em rgba(10, 10, 10, 0.1), 0 0px 0 1px rgba(10, 10, 10, 0.02);
  border-bottom-left-radius: 6px;
  border-bottom-right-radius: 6px;

}

.tag-selected {
  display: inline-block;
  margin: 3px 3px 3px 3px;
  width: 40px;
  height: 35px;
  background-color: transparent;
  border: 1px solid hsl(0, 0%, 76%);
  padding: 6px;
  /*border-radius: 6px;*/
  text-align: center;
  text-decoration: none;
  font-size: 14px;
  outline: none;
}

.action-btn {
  display: inline-block;
  margin: 3px 3px 3px 3px;
  width: 150px;
  height: 35px;
  background-color: transparent;
  border: 1px solid hsl(0, 0%, 76%);
  padding: 6px;
  /*border-radius: 6px;*/
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  outline: none;
}

.action-btn > i{
  vertical-align: center;
  font-size: 16px;
}

.action-btn:hover {
  border: 1px solid black;
}

.action-input {
  margin: 3px 6px 3px 6px;
  border: 1px solid hsl(0, 0%, 76%);
  text-align: center;
  color: black;
  /*border-radius: 6px;*/
  padding: 6px 12px 6px 12px;
  width: 42px;
  font-size: 14px;
  outline: none;
}

.action-input:focus {
  /* when clicked inside element */
  border: 1px solid hsl(0, 0%, 56%);
  background-color: hsl(0, 0%, 96%);
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  appearance: none;
  margin: 0;
}
</style>
