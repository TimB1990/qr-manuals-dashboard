<template>
  <div>
      <div>
        <p>QR code scream</p>
      </div>
      <section class="scanner">
        <qrcode-stream @decode="onDecode" @init = "onInit"></qrcode-stream>
      </section>
      <div>
        <p class="error">
          <b>{{ error }}</b>
        </p>
        <p class="decode-result">
          <b>{{ result }}</b>
        </p>
      </div>
    </div>
</template>

<script>
// import { QrcodeStream, QrcodeDropZone, QrcodeCapture } from 'vue-qrcode-reader'
import { QrcodeStream } from "vue-qrcode-reader";
export default {
  name: "scanner",
  components: { QrcodeStream },
  data() {
    return {
      result: "",
      error: ""
    };
  },
  methods: {
    onDecode(result) {
      this.result = result;
    },

    async onInit(promise) {
      try {
        await promise;
      } catch (error) {
        this.error = error.name;
      }
    }
  }
};
</script>

<style>
.error{
  color: red;
}

.scanner{
  padding: 16px;
  border: 1px solid black;
}
</style>