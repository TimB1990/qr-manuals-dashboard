<template>
    <section class="scanner">
        <div class="scanner-head">qr scanner</div>

        <div class="scanner-body">
            <qrcode-stream @decode="onDecode" @init="onInit"> </qrcode-stream>
        </div>

        <div class="scanner-footer">
            <div class="artnr-panel">
                <em>
                    Or instead provide the 8 digit product code
                </em>
                <input
                    v-model="artnr"
                    id="artnr"
                    type="text"
                    maxlength="9"
                    pattern="[0-9]{4}\.[0-9]{2}"
                    placeholder="000000.00"
                />
                <button @click="submitProductcode">Submit Productcode</button>
            </div>
            <p class="invalid-msg">
                <em>{{ error }}</em>
            </p>
        </div>
    </section>
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
            const regex = /^[0-9]{6}\.[0-9]{2}/g;
            if (regex.test(this.artnr)) {
                this.error = "";
                this.$router.push({
                    name: "view",
                    params: {
                        artnr: this.artnr
                    }
                });
            } else {
                this.error =
                    "This productcode is not valid, make sure you are using the right format: 8 digits total seperated by '.' before the last 2 digits";
            }
        }
    }
};
</script>
