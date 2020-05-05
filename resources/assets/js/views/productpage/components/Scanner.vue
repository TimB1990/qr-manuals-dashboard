<template>
  <div>
    <section class="scanner">
      <div class="scanner-head">Scan your QR code below...</div>

      <div class="scanner-body">
        <qrcode-stream  @decode="onDecode" @init="onInit"></qrcode-stream>
      </div>

      <div class="scanner-footer">
        <em>
          Or instead provide the
          <strong>9 digit productcode</strong>
        </em>

        <div class="artnr-panel">
          <input
            v-model="artnr"
            id="artnr"
            type="text"
            maxlength="9"
            pattern="[0-9]{4}\.[0-9]{2}"
            placeholder="000000.00"
          />
          <button @click="submitProductcode" id="artnr-submit">Go</button>
        </div>
        <p class="error-msg">
          <em>{{ error }}</em>
        </p>
      </div>
    </section>
  </div>
</template>

<script>
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
    },

    submitProductcode() {
      // check for valid code format
      const regex = /^[0-9]{6}\.[0-9]{2}/g
      if (regex.test(this.artnr)) {
        this.error = "";
        this.$router.push({ path: `/view/${this.artnr}` });
      } else {
        this.error = "The productcode is not valid";
      }
    }
  }
};
</script>

<style scoped>
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

.error-msg {
  color: red;
  font-size: 16px;
}

.scanner-body {
  padding: 12px;
  border: 1px solid hsl(0, 0%, 80%);
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
  justify-content: center;
  align-items: center;
  border: 1px solid hsl(0, 0%, 80%);
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
  letter-spacing: 12px;
  border: 1px solid hsl(0, 0%, 80%);
  font-size: 20px;
  height: 50px;
  width: 215px;
}

.invalid{
  border: 1px solid red;
}

#artnr-submit {
  width: 50px;
  height: 50px;
  background-color: white;
  border: 1px solid hsl(0, 0%, 80%);
  outline: none;
}

#artnr-submit:hover {
  border: 1px solid black;
  background-color: hsl(0, 0%, 96%);
}

/*#divInner{
  left: 0;
  position: sticky;
}*/
</style>