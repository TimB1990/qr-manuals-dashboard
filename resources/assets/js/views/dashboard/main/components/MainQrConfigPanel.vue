<template>
    <div class="content-root">
        <div class="panel-layout">
            <div class="config-panel">
                <div class="sub-panel">
                    <p>Layout blueprints</p>
                    <b>rows:</b>
                    <input v-model="rows" type="number" />
                    <b>cols:</b>
                    <input v-model="cols" type="number" />
                    <b>Paper Size:</b>
                    <select
                        v-model="currentPaperFormat"
                        name="paper"
                        id="paper"
                    >
                        <option
                            v-for="format in paperSizes(1, 4)"
                            :key="format.name"
                            :value="`${format.width}x${format.height}`"
                        >
                            {{ format.name }}: {{ format.width }} *
                            {{ format.height }} mm
                        </option>
                    </select>
                </div>
                <div class="sub-panel">
                    <ul>
                        <li>
                            page:
                            {{
                                this.selectedProducts.length > 1
                                    ? this.current_page
                                    : 1
                            }}
                            of {{ this.max_pages ? this.max_pages : 1 }}
                        </li>
                        <li>items per page: {{ page_size }}</li>
                    </ul>
                </div>
            </div>
            <em>toggle one or more products to generate QR-codes on sheet</em>

            <div id="sheet">
                <div v-if="this.currentPaperFormat" :style="sheetBlueprint">
                    <div
                        v-for="n in page_size"
                        :key="n"
                        :style="itemBlueprint"
                        class="sheet__blueprint"
                    >
                        <span style="color:hsl(0,0%,80%);">
                            {{ itemBlueprint.width }} x
                            {{ itemBlueprint.height }}
                        </span>
                    </div>
                    <div :style="sheetItems">
                        <main-qr-item
                            v-for="item in paginated()"
                            :key="item.id"
                            :id="item.id"
                            :artnr="item.artnr"
                            :kind="item.kind"
                            :qrSizeRatio="0.8"
                            :width="parseInt(itemBlueprint.width.replace('mm',''))"
                            :height="parseInt(itemBlueprint.height.replace('mm',''))"
                        ></main-qr-item>
                    </div>
                </div>
            </div>

            <div class="config-panel">
                <button class="btn" @click="prevPage">&laquo;</button>
                <button class="btn" @click="download()">download pdf</button>
                <button class="btn" @click="nextPage">&raquo;</button>
            </div>
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
            rows: 4,
            cols: 4,
            current_page: 1,
            max_pages: 1,
            currentPaperFormat: null
        };
    },

    methods: {
        paperSizes(fromAformat, toAformat) {
            let sizesArray = [];

            for (var i = toAformat; i >= fromAformat; i--) {
                var height = Math.sqrt(Math.pow(2, 0 - i + 0.5)) * 1000;
                var width = Math.sqrt(Math.pow(2, 0 - i - 0.5)) * 1000;

                sizesArray.push({
                    name: "A" + i,
                    height: Math.round(height),
                    width: Math.round(width)
                });
            }

            return sizesArray;
        },
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
            /*var canvas = document.getElementById("sheet");

            html2canvas(canvas, {
                // options
                scale: 1
            }).then(canvas => {
                var imgData = canvas.toDataURL("image/png");
                var doc = new jspdf();
                doc.addImage(imgData, "PNG", 0, 0);
                doc.save("sheet.pdf");
            });*/
            // API call using laravel simple pdf
        }
    },

    computed: {
        selectedProducts() {
            return this.$store.state.selectedProducts;
        },

        page_size() {
            return this.rows * this.cols;
        },

        // DYNAMIC STYLING
        sheetItems() {
            if (this.currentPaperFormat) {
                var paperWidth = parseInt(
                    this.currentPaperFormat.split("x")[0]
                );
                var paperHeight = parseInt(
                    this.currentPaperFormat.split("x")[1]
                );

                return {
                    position: "absolute",
                    border: "1px solid red",
                    top: 0,
                    left: 0,
                    width: `${paperWidth}mm`,
                    height: `${paperHeight}mm`,
                    display: "flex",
                    alignContent: "flex-start",
                    flexWrap: "wrap",
                    padding: `12mm`
                };
            }
        },

        sheetBlueprint() {
            if (this.currentPaperFormat) {
                var paperWidth = parseInt(
                    this.currentPaperFormat.split("x")[0]
                );
                var paperHeight = parseInt(
                    this.currentPaperFormat.split("x")[1]
                );

                return {
                    position: "relative",
                    width: `${paperWidth}mm`,
                    height: `${paperHeight}mm`,
                    opacity: 1,
                    display: "flex",
                    flexWrap: "wrap",
                    alignContent: "flex-start",
                    padding: `12mm`,
                    border: "1px solid grey"
                };
            }
        },

        itemBlueprint() {
            if (this.currentPaperFormat) {
                var paperWidth = parseInt(
                    this.currentPaperFormat.split("x")[0]
                );
                var paperHeight = parseInt(
                    this.currentPaperFormat.split("x")[1]
                );

                return {
                    height: `${Math.round((paperHeight - 12) / this.rows)}mm`,
                    width: `${Math.round((paperWidth - 12) / this.cols)}mm`,
                    display: "flex",
                    justifyContent: "center",
                    alignItems: "center",
                    border: "1px dashed hsl(0, 0%, 65%)",
                    borderRadius: "1rem"
                };
            }
        }
    }
};
</script>
