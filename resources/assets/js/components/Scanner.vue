<template>
  <!-- shoud contain class is-active -->
  <div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card">
      <div class="modal-card-head">
        <p class="modal-card-title">QR code scream</p>
        <button class="delete" aria-label="close" @click="close"></button>
      </div>
      <section class="modal-card-body">
        <qrcode-stream @decode="onDecode" @init = "onInit"></qrcode-stream>
      </section>
      <footer class="modal-card-foot">
        <p class="error">
          <b>{{ error }}</b>
        </p>
        <p class="decode-result">
          <b>{{ result }}</b>
        </p>
      </footer>
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

    close() {
      // emit close event to ExtendSearch.vue
      this.$emit("close");
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
.modal-cont > p {
  color: white;
}
.error{
  color: red;
}
</style>