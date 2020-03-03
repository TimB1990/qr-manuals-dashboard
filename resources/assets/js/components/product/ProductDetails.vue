<template>
  <div class="container">
    <div v-if="!this.productSelected">
      <p>No product selected...</p>
    </div>
    <div v-else>
      <p>details</p>
      <div>
        <table class="table is-bordered is-fullwidth">
          <tr v-for="detail in this.details" :key="detail.key">
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
              <qrcode-vue :value="qrValue" :size="qrSize" level="H"></qrcode-vue>
            </td>
          </tr>
          <tr>
            <td>url:</td>
            <td>
              <a>{{ qrValue }}</a>
            </td>
          </tr>
        </table>
      </div>
      <hr />
      <p>Manuals</p>
      <!-- load manuals -->
      <div>
        <table class="table is-fullwidth">
          <tr v-for="manual in this.manuals" :key="manual.id">
            <td>
              <p>{{ manual.file_name }}</p>
              <span class="has-text-weight-light">{{ manual.file_url }}</span>
            </td>
            <td class="has-text-right">
              <a :href="manual.file_url" class="button is-primary">Download Copy</a>
            </td>
            <td>
              <button @click="deleteManual(details[0].value, manual)">delete</button>
            </td>
          </tr>
        </table>
      </div>
      <br />
      <!-- upload files button -->
      <button style="float:right;" @click="toggleUpload" class="button is-primary is-outlined">
        <span class="file-icon">
          <i class="fa fa-upload"></i>
        </span>
        Upload New Manual
      </button>

      <upload
        class="tile is-child box"
        :product-id="details[0].value"
        v-if="openUpload"
        @close="toggleUpload"
      ></upload>
    </div>
  </div>
</template>

<script>
import QrcodeVue from "qrcode.vue";
import Upload from "./Upload";

export default {
  name: "productdetails",
  components: { QrcodeVue, Upload },

  data() {
    return {
      openUpload: false,
      qrSize: 100,
      details: [],
      manuals: null,
      productSelected: false
    };
  },
  methods: {
    deleteManual(id, manual) {
      axios
        .delete(`/products/${id}/manuals/${manual.id}`)
        .then(response => {
          this.manuals.splice(this.manuals.indexOf(manual), 1);
        })
        .catch(error => console.log(error));
    },

    toggleUpload() {
      this.openUpload = !this.openUpload;
    },
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
          // some logic to handle this feature reactive
          this.manuals = response.data;
        })
        .catch(error => console.log(error));
    }
  },

  computed: {
    // this computed is actually a property value set by the return statement, no adjustments to properties in this component can be done by using computed properties
    qrValue(){
      return "https://example.com/products/" + this.details[1].value; 
    }
  },

  beforeMount(){
    this.$on('attached', () => {
      this.getManuals(this.details[0].value);

    });
  },

  created() {
    // on created this component listens to the event loadDetails sent from productsList
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

