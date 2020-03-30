<template>
  <div>
    <section class="scanner">
      <div class="scanner-head">Scan your QR code below...</div>

      <div class="scanner-body">
        <qrcode-stream :camera="auto" @decode="onDecode" @init="onInit"></qrcode-stream>
        <p class="error">
          <b>{{ error }}</b>
        </p>
      </div>

      <div class="scanner-footer">
        <input id="artnr" type="text" maxLength="9"/>
      </div>
    </section>
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
      this.$router.push({ path: `/view/${result}` });
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
.error {
  color: red;
}

.scanner {
  display: flex;
  flex-direction: column;
  background-color: white;
  padding: 12px;
  box-shadow: 0 0.5em 1em -0.125em rgba(10, 10, 10, 0.1),
    0 0px 0 1px rgba(10, 10, 10, 0.02);
}

.scanner-body {
  padding: 12px;
  height: 300px;
}

.scanner-head {
  font-size: 20px;
  font-weight: bold;
  text-align: center;
}

.scanner-footer {
  display: flex;
  padding: 12px;
  height: 150px;
  border: 1px solid black;
  justify-content: center;
  align-items: center;
}

#artnr {
  padding-left: 12px;
  padding-right: 12px;
  letter-spacing: 12px;
  border: 1px solid black;
  font-size:18px;
  height: 50px;
  width: 210px;
}

/*#divInner{
  left: 0;
  position: sticky;
}*/

</style>