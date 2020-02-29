<template>
  <div class="container">
    <div v-if="!this.productSelected">
      <p>No product selected...</p>
    </div>
    <div v-else>
      <p>details</p>
      <div>
        <table class="table is-bordered is-fullwidth">
          <tr v-for="(detail, index) in this.details" :key="index">
            <td class="has-text-left">{{detail.key}}</td>
            <td class="has-text-right">{{detail.value}}</td>
          </tr>
        </table>
      </div>
      <hr />
      <p>Product page</p>
      <div>
        <table class="table is-bordered is-fullwidth">
          <tr>
            <td>artnr:</td>
            <td>{{ details[1].value }}</td>
            <td id="qrcode-canvas" class="has-text-centered" rowspan="2">
              <qrcode-vue :value="QrValue" :size="QrSize" level="H"></qrcode-vue>
            </td>
          </tr>
          <tr>
            <td>url:</td>
            <td>
              <a>{{ QrValue }}</a>
            </td>
          </tr>
        </table>
      </div>
      <hr />
      <p>Manuals</p>
      <div>
        <table class="table is-fullwidth">
          <tr v-for="(manual, index) in this.manuals" :key="index">
            <td>
              <p>{{ manual.file_name }}</p>
              <span class="has-text-weight-light">{{ manual.file_url }}</span>
            </td>
            <td class="has-text-right">
              <a :href="manual.file_url" class="button is-primary">Download Copy</a>
            </td>
          </tr>
        </table>
      </div>
      <br />
      <!-- upload files button -->
    </div>
  </div>
</template>

<script>
import QrcodeVue from "qrcode.vue";

export default {
  components: { QrcodeVue },
  data() {
    return {
      QrValue: "https://example.com/products/12345",
      QrSize: 100,
      details: [],
      manuals: null,
      productSelected: false
    };
  },
  methods: {
    getDetails(id) {
      axios
        .get(`/products/${id}/details`)
        .then(response => {
          // map object.keys from response data to 'key' : 'value'
          this.details = Object.keys(response.data).map(key => {
            return {
              key: key.replace(/_/g, " "),
              value: response.data[key]
            };
          });
        })
        .catch(error => console.log(error));
    },

    getManuals(id) {
      axios
        .get(`/products/${id}/manuals`)
        .then(response => {
          this.manuals = response.data;
        })
        .catch(error => console.log(error));
    }
  },

  created() {
    // on created this component listens to the event loadDetails send from productsList
    this.$root.$on("product", id => {
      this.productSelected = true;
      this.getDetails(id);
      this.getManuals(id);
    });
  }
};
</script>
<style>
p {
  font-weight: bold;
}
</style>

