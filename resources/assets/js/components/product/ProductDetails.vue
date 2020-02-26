<template>
  <div class="container">
    <p>details</p>
    <div>
      <table class="table is-fullwidth">
        <tr v-for="(detail, index) in this.details" :key="index">
          <td>{{detail.key}}</td>
          <td>{{detail.value}}</td>
        </tr>
      </table>
    </div>
    <hr />
    <p>Product page</p>
    <div>
      <table class="table is-fullwidth">
        <tr>
          <td>artnr:</td>
          <td>211240.30</td>
          <td id="qrcode-canvas" class="has-text-centered" rowspan="2">
            <qrcode-vue :value="QrValue" :size="QrSize" level="H"></qrcode-vue>
          </td>
        </tr>
        <tr>
          <td>url:</td>
          <td>{{this.value}}</td>
        </tr>
      </table>
    </div>
    <hr />
    <p>Manuals</p>
    <div>
      <table class="table is-fullwidth">
        <tr>
          <td>file:</td>
          <td>UserManual.pdf</td>
        </tr>
        <tr>
          <td>download url:</td>
          <td>
            <a>{{this.value}}/download?file=user-manual</a>
          </td>
        </tr>
      </table>
      <table class="table is-fullwidth">
        <tr>
          <td>file:</td>
          <td>TechnicalDescription.pdf</td>
        </tr>
        <tr>
          <td>download url:</td>
          <td>
            <a>{{this.value}}/download?file=technical-description</a>
          </td>
        </tr>
      </table>
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
      details: null,
      keys: null
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
                'key': key.replace(/_/g, " "),
                'value': response.data[key]
              }
            });
        })
        .catch(error => console.log(error));
    }
  },

  created(){
      // on created this component listens to the event loadDetails send from productsList
      this.$root.$on('loadDetails', (id) => {
          console.log('id');
          this.getDetails(id);
      })
  }
};
</script>
<style>
p {
  font-weight: bold;
}
</style>

