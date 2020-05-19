<template>
    <div class="content-root">
        <div>
            <em>toggle one or more products to generate QR-codes on sheet</em>
            <span>
                paper format: A4, page:
                {{ this.selectedProducts.length > 1 ? this.current_page : 1 }}
                of
                {{ this.max_pages ? this.max_pages : 1 }}
            </span>
        </div>

        <div class="sticker-sheet-underlay">
            <div
                v-for="n in this.page_size"
                :key="n"
                class="qr-item-blueprint"
            ></div>
        </div>

        <div id="sheet" class="sticker-sheet">
            <main-qr-item
                v-for="item in paginated()"
                :key="item.id"
                :id="item.id"
                :artnr="item.artnr"
                :kind="item.kind"
            ></main-qr-item>
        </div>
        <div class="config-panel">
            <button @click="prevPage">&laquo;</button>
            <button @click="nextPage">&raquo;</button>
            <button @click="download">download pdf</button>
        </div>
    </div>
</template>

<script>
import MainQrItem from "./MainQrItem";
import jspdf from "jspdf";
import html2canvas from "html2canvas";

export default {
    name: "mainQrConfigPanel",
    components: { MainQrItem },

    data() {
        return {
            page_size: 16,
            current_page: 1,
            max_pages: 1
        };
    },

    methods: {
        nextPage() {
            console.log("called next page");
            let max_pages = this.max_pages;

            if (this.selectedProducts.length == 0) {
                this.current_page = 1;
                this.max_pages = 1;
            }

            if (this.current_page < max_pages) {
                this.current_page += 1;
            } else {
                this.current_page = max_pages;
            }
        },
        prevPage() {
            if (this.current_page > 1) {
                this.current_page -= 1;
            } else {
                this.current_page = 1;
            }
        },

        paginated() {
            let paginated = this.$store.getters.paginatedSelection(
                this.current_page,
                this.page_size
            );
            this.max_pages = Math.ceil(
                this.selectedProducts.length / this.page_size
            );
            return paginated[0].items;
        },

        download() {
            var canvas = document.getElementById("sheet");

            html2canvas(canvas, {
                // options
                scale: 1
            }).then(canvas => {
                var imgData = canvas.toDataURL("image/png");
                var doc = new jspdf();
                doc.addImage(imgData, "PNG", -3, -3);
                doc.save("sheet.pdf");
            });
        }
    },

    computed: {
        selectedProducts() {
            return this.$store.state.selectedProducts;
        }
    }
};
</script>

<style>
.config-panel {
    border: 1px solid grey;
    display: flex;
    justify-content: space-evenly;
    padding: 8px;
    margin-bottom: 24px;
}

.sticker-sheet {
    display: flex;
    align-content: flex-start;
    flex-wrap: wrap;
    border: 1px solid grey;
    width: 100%;
    height: 100%;
    width: 210mm;
    height: 297mm;
    padding: 11.5mm;
}

.sticker-sheet-underlay {
    /*background-color: hsl(300, 50%, 90%);*/
    opacity: 0.5;
    display: flex;
    flex-wrap: wrap;
    align-content: flex-start;
    position: absolute;
    width: 210mm;
    height: 297mm;
    padding: 11.5mm;
    z-index: -1;
}

.qr-item-blueprint {
    height: 55mm;
    width: 40mm;
    border: 1px dashed hsl(0, 0%, 65%);
    border-radius: 12px;
    margin: 12px;
    z-index: -1;
}

button:disabled {
    background-color: red;
}
</style>
