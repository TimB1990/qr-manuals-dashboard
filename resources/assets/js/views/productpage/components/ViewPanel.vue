<template>
  <div class="menu-root">
    <div v-if="this.isLoading" class="loading">
      <span class="loader"></span>
    </div>

    <table v-if="!this.isLoading">
      <tr>
        <td class="menu-header">
          <p id="product">
            {{ this.product[0].name}}
            <i id="stock" class="fa fa-check-circle"></i>
          </p>
          <p>product id: {{ this.product[0].id}}</p>
          <p>Art nr. {{ this.$route.params.artnr}}</p>
        </td>
      </tr>
      <tr>
        <td class="menu-category">
          <i class="fas fa-book"></i>
          Documentation
        </td>
      </tr>

      <tbody v-if="this.manuals && this.manuals.length > 0">
        <tr v-for="manual in this.manuals" :key="manual.id">
          <td class="menu-item">
            <a
              :href="manual.file_url"
            >{{ manual.file_name.substring(0, manual.file_name.length - 4) }} (pdf)</a>
            <i class="fa fa-chevron-right"></i>
          </td>
        </tr>
      </tbody>

      <tbody v-else>
        <tr>
          <td class="menu-item">No manuals found</td>
        </tr>
      </tbody>

      <tr>
        <td class="menu-category">
          <i class="fa fa-box-open"></i>
          Product
        </td>
      </tr>
      <tr>
        <td @click="gotoQuoteform" class="menu-item">
          Request a quote
          <i class="fa fa-chevron-right"></i>
        </td>
      </tr>
      <tr>
        <td class="menu-item">
          Order product online
          <i class="fa fa-chevron-right"></i>
        </td>
      </tr>
      <tr>
        <td class="menu-footer"></td>
      </tr>
    </table>
    <div v-if="!this.isLoading" class="page-footer">
      <button @click="gotoScanner">Scan a product</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "viewpanel",
  data() {
    return {
      product: [],
      manuals: [],
      isLoading: true
    };
  },

  created() {
    this.setProductManuals(this.$route.params.artnr);
  },

  methods: {
    gotoScanner() {
      this.$router.push({ path: "/productpage" });
    },

    async setProductManuals(artnr) {
      // axios.get(`/api/products/${artnr}`)
      try {
        const product = await axios.get(`api/products/${artnr}`);
        console.log("product: ", product);
        
        const manuals = await axios.get(
          `/api/products/${product.data[0].id}/manuals`
        );
        console.log("manuals: ", manuals);

        this.product = product.data;
        this.manuals = manuals.data;

        this.isLoading = false;
      } catch (error) {
        console.log(error);
      }
    },

    gotoQuoteform() {
      this.$router.push({
        name: "quote",
        query: {
          artnr: this.product[0].artnr,
          name: this.product[0].name
        }
      });
    }
  }
};
</script>

<style>
table {
  width: 100%;
  box-shadow: 0 0.5em 1em -0.125em rgba(10, 10, 10, 0.1),
    0 0px 0 1px rgba(10, 10, 10, 0.02);
}

.menu-category {
  background-color: #cc0033;
  word-spacing: 3px;
  color: white;
  padding: 12px;
}

.loading {
  display: flex;
  height: 400px;
  justify-content: center;
  align-items: center;
  box-shadow: 0 0.5em 1em -0.125em rgba(10, 10, 10, 0.1),
    0 0px 0 1px rgba(10, 10, 10, 0.02);
}

.loader {
  border: 8px solid #f3f3f3; /* Light grey */
  border-top: 16px solid grey; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

.menu-item {
  display: flex;
  justify-content: space-between;
  align-items: baseline;
  background-color: white;
  padding: 14px;
  border: 1px solid hsl(0, 0%, 96%);
}

.menu-item:hover {
  background-color: hsl(0, 0%, 94%);
  border: 1px solid hsl(0, 0%, 85%);
}

.menu-item > i {
  font-size: 10px;
}

a:link {
  color: grey;
}

.menu-header {
  padding-left: 16px;
  padding-bottom: 18px;
  padding-top: 18px;
  background-color: white;
}

.menu-footer {
  padding: 28px;
  background-color: white;
}

#stock {
  font-size: 21px;
  color: #29a329;
  padding-left: 6px;
  padding-right: 6px;
}

#product {
  font-weight: bold;
  font-size: 18px;
  color: black;
}
</style>