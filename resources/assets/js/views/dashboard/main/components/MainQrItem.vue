<template>
    <div :style="itemStyle">
        <div class="qr-item-head">
            <p>{{ this.kind }}</p>
            <p>{{ this.artnr }}</p>
        </div>
        <div>
            <qrcode-vue
                :value="qrValue"
                :size="Math.sqrt((dimensions.width * dimensions.height) * dimensions.qrRatio *3.78 )"
                level="H"
            ></qrcode-vue>
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
        dimensions: Object
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

        itemStyle() {
            return {
                display: "flex",
                flexDirection: "column",
                justifyContent: "space-evenly",
                height: `${this.dimensions.height}mm`,
                width: `${this.dimensions.width}mm`,
                border: "1px solid black",
                backgroundColor: "white",
                borderRadius: "1rem",
                textAlign: "center",
                padding: "0.25rem"
            };
        }
    }
};
</script>
