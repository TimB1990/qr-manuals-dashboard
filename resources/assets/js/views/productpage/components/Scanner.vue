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
        <em>Or instead provide the <strong>9 digit productcode</strong></em>
        <em>Example: 000000.00</em>

        <div class="artnr-panel">
          <input v-model="artnr" id="artnr" type="text" maxlength="9" pattern="[0-9]{4}\.[0-9]{2}" />
          <button id="artnr-submit">Go</button>
        </div>
      </div>
      <p>
        <code v-if="this.artnr.length > 0">{{ this.artnr }}</code>
      </p>
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
      error: "",
      artnr: ""
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
  justify-content: space-between;
  padding-left: 12px;
  padding-right: 12px;
  padding-bottom: 24px;
  padding-top: 12px;
  box-shadow: 0 0.5em 1em -0.125em rgba(10, 10, 10, 0.1),
    0 0px 0 1px rgba(10, 10, 10, 0.02);
}

.scanner-body {
  padding: 12px;
  border: 1px solid hsl(0,0%,80%);
  margin-bottom: 16px;
  margin-top: 16px;
}

.scanner-head {
  font-size: 20px;
  font-weight: bold;
  text-align: center;
}

.scanner-footer {
  display: flex;
  flex-direction: column;
  padding: 12px;
  height: 150px;
  /*border: 1px solid hsl(0, 0%, 80%);*/
  justify-content: center;
  align-items: center;
  /*box-shadow: 0 0.5em 1em -0.125em rgba(10, 10, 10, 0.1),
    0 0px 0 1px rgba(10, 10, 10, 0.02);*/
  border: 1px solid hsl(0,0%,80%);
}

.artnr-panel {
  display: flex;
  padding: 6px;
  border: none;
  width: 300px;
  justify-content: space-evenly;
}

#artnr {
  padding-left: 12px;
  padding-right: 12px;
  letter-spacing: 12px;
  border: 1px solid hsl(0,0%,80%);
  font-size: 18px;
  height: 50px;
  width: 230px;
}

#artnr-submit {
  width: 50px;
  height: 50px;
  background-color: white;
  border: 1px solid hsl(0,0%,80%);
  outline: none;
}

#artnr-submit:hover {
  border: 1px solid black;
  background-color: hsl(0,0%,96%);
}

/*#divInner{
  left: 0;
  position: sticky;
}*/
</style>