<template>
    <section class="scanner">
        <div class="scanner-head">qr scanner</div>

        <div class="scanner-body">
            <qrcode-stream :track="true" @decode="onDecode" @init="onInit">
            </qrcode-stream>
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
                    pattern="[0-9]{8}"
                    placeholder="12345678"
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
            this.$router.push({
                name: "view",
                params: {
                    artnr: result
                }
            });
        },

        async onInit(promise) {
            try {
                await promise;
            } catch (error) {
                // in production gives insecure context error
                if (error.name === "NotAllowedError") {
                    // user denied camera access permisson
                    this.error = "You need to accept camera access in order to scan a qrcode"
                } else if (error.name === "NotFoundError") {
                    this.error = "There is no working camera installed"
                } else if (error.name === "NotSupportedError") {
                    this.error = "This page is not served over HTTPS (or localhost)"
                } else if (error.name === "NotReadableError") {
                    this.error = "cannot read code, maybe camera is already in use"
                } else if (error.name === "OverconstrainedError") {
                    this.error = "Cannot use camera, did you requested the front camera although there is none?"
                } else if (error.name === "StreamApiNotSupportedError") {
                    this.error ="The stream api is not supported, the browser seems to be lacking features"
                }
            }
        },

        submitProductcode() {
            // check for valid code format
            const regex = /^[0-9]{8}/g;
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
                    "This productcode is not valid, make sure you are using the right format, make sure the length is exactly 8 digits";
            }
        }
    }
};
</script>
