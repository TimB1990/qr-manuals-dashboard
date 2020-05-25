<template>
    <div class="qr-item">
        <div class="qr-item-head">
            <p>{{ this.kind }}</p>
            <p>{{ this.artnr }}</p>
        </div>
        <div>
            <qrcode-vue :value="qrValue" :size="qrSize" level="H"></qrcode-vue>
        </div>
    </div>
</template>

<script>
import QrcodeVue from "qrcode.vue";
export default {
    name: "mainQrItem",
    props: {
        id: Number,
        kind: String,
        artnr: String
    },
    components: { QrcodeVue },
    data() {
        return {
            qrSize: 100
        };
    },
    computed: {
        qrValue() {
            // return `${this.id}-${this.artnr}-${this.name}-${this.kind}`;
            return `${this.artnr}`;
        }
    }
};
</script>
