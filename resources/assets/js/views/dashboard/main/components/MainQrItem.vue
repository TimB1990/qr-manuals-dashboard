<template>
    <div :style="item">
        <div class="qr-item-head">
            <p>{{ this.kind }}</p>
            <p>{{ this.artnr }}</p>
        </div>
        <div>
            <qrcode-vue
                :value="qrValue"
                :size="80"
                level="H"
            ></qrcode-vue>
            <code>{{ this.width}}x{{this.height}}</code>
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
        artnr: String,
        qrSizeRatio: Number,
        width: Number,
        height: Number
    },
    components: { QrcodeVue },
    data() {
        return {
            //
        };
    },
    computed: {
        qrValue() {
            return `${this.artnr}`;
        },

        // dynamic styling
        item() {
            return {
                width: `${this.width}mm`,
                height: `${this.height}mm`,
                border: "1px solid black",
                borderRadius: "1rem",
                textAlign: "center",
                padding: "0.25rem",
            };
        }
    }
};
</script>
