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
      <span class="tag-selected">selected: {{ selectedProductCount }}</span>
      <button class="action-btn" @click.prevent="clearSelected">Clear</button>
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
  border: 1px dashed black;
  border-top-color: white;
  padding: 12px;
}

.tag-selected {
  padding: 8px 12px 8px 12px;
  border: 1px solid hsl(0, 0%, 76%);
  background-color: transparent;
  /*border-radius: 6px;*/
  font-size: 14px;
}

.action-btn {
  margin: 3px 3px 3px 3px;
  background-color: transparent;
  border: 1px solid hsl(0, 0%, 76%);
  padding: 8px 12px 8px 12px;
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
  border: 1px solid hsl(0, 0%, 76%);
  background-color: hsl(0, 0%, 86%);
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
