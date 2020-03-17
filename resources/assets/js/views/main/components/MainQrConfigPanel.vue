<template>
  <div>
    <strong>QR configuration panel</strong>
    <em>toggle one or more products to generate QR-codes on sheet</em>
    <button>next</button><button>previous</button>

    <p>
      <code>{{ selectedProducts }}</code>
    </p>
    <br />

    <!-- this element represents the background like blueprint -->
    <div class="sticker-sheet-underlay">
      <div v-for="n in 16" :key="n" class="qr-item-blueprint"></div>
    </div>

    <div class="sticker-sheet">
      <span>paper format: A4, page: 1</span>
      <main-qr-item
        v-for="selected in selectedProducts"
        :key="selected.id"
        :artnr="selected.artnr"
        :kind="selected.kind"
      ></main-qr-item>
    </div>
  </div>
</template>

<script>
import MainQrItem from "./MainQrItem";
export default {
  name: "mainQrConfigPanel",
  components: { MainQrItem },

  data() {
    return {
      page_size: 16,
      current_page: 1
    };
  },

  methods: {
    nextPage() {
      const max_pages = Math.ceil(selectedProducts.length / this.page_size);
      if (this.current_page < max_pages) {
        this.current_page += 1;
      } else {
        this.current_page = max_pages;
      }
    },
    prevPage() {
      if (this.current_page > 1) {
        this.current_page -= 1;
      } else {
        this.current_page = 1;
      }
    }
  },

  computed: {
    selectedProducts() {
      return this.$store.state.selectedProducts;
    },

    paginated() {
      const page_size = this.page_size;
      let items = this.$store.state.selectedProducts;
      let pages = Math.ceil(items.length / page_size);
      let paginated = [];

      for (var i = 0; i < pages; i++) {
        paginated.push({
          page: i + 1,
          items: items.slice((i + 1 - 1) * page_size, (i + 1) * page_size)
        });
      }

      return paginated;
    }
  }
};
</script>

<style>
.sticker-sheet {
  display: flex;
  align-content: flex-start;
  flex-wrap: wrap;
  border: 1px solid grey;
  width: 100%;
  height: 100%;
  width: 210mm;
  height: 297mm;
  padding: 11.5mm;
}

.sticker-sheet > span {
  position: absolute;
  margin-top: -58px;
  margin-left: 2px;
  padding-left: 9px;
  padding-right: 9px;
  background: white;
}

.sticker-sheet-underlay {
  background-color: hsl(300, 50%, 90%);
  opacity: 0.5;
  display: flex;
  flex-wrap: wrap;
  align-content: flex-start;
  position: absolute;
  width: 210mm;
  height: 297mm;
  padding: 11.5mm;
  z-index: -1;
}

.qr-item-blueprint {
  height: 55mm;
  width: 40mm;
  border: 1px dashed hsl(0, 0%, 65%);
  border-radius: 12px;
  margin: 12px;
  z-index: -1;
}
</style>
