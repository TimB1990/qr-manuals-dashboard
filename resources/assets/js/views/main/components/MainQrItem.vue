<template>
  <div class="qr-item">
    <div class="qr-item-head">
      <p>{{ this.kind }}</p>
      <p>{{ this.artnr }}</p>
    </div>
    <div class="qr-item-box">
      <qrcode-vue :value="qrValue" :size="qrSize" level="H"></qrcode-vue>
    </div>
  </div>
</template>

<script>
import QrcodeVue from "qrcode.vue";
export default {
  name: "mainQrItem",
  props:{
    kind: String,
    artnr: String,
  },
  components: { QrcodeVue },
  data() {
    return {
      qrSize: 100
    };
  },
  computed: {
    qrValue() {
      return `https://example.com/products/${this.artnr}`;
    }
  }
};
</script>

<style>
.qr-item {
  height: 55mm;
  width: 40mm;
  border: 1px solid black;
  border-radius: 12px;
  padding: 8px;
  margin: 12px;
}

.qr-item-head {
  font-weight: bold;
  text-align: center;
}

.qr-item-box {
  padding: 12px;
  /*background: linear-gradient(to right, black 3px, transparent 3px) 0 0,
    linear-gradient(to right, black 3px, transparent 3px) 0 100%,
    linear-gradient(to left, black 3px, transparent 3px) 100% 0,
    linear-gradient(to left, black 3px, transparent 3px) 100% 100%,
    linear-gradient(to bottom, black 3px, transparent 3px) 0 0,
    linear-gradient(to bottom, black 3px, transparent 3px) 100% 0,
    linear-gradient(to top, black 3px, transparent 3px) 0 100%,
    linear-gradient(to top, black 3px, transparent 3px) 100% 100%;*/

  background-repeat: no-repeat;
  background-size: 18px 18px;
}
</style>