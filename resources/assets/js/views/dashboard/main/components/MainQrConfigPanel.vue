<template>
    <div class="content-root">
        <div class="panel-layout">
            <div class="panel-layout-header">
                <span><b>Layout Blueprint</b> </span>
                <span>
                    page
                    {{
                        this.selectedProducts.length > 1 ? this.current_page : 1
                    }}
                    of {{ this.max_pages ? this.max_pages : 1 }}
                </span>
                <span>items per page: {{ page_size }}</span>
            </div>
            <!-- config panel -->
            <div class="config-panel">
                <div>
                    <b>Name/Alias:</b>
                    <input
                        v-model="alias"
                        type="text"
                        placeholder="new sheet"
                    />
                    <b>Rows:</b>
                    <input v-model="rows" type="number" />
                    <b>Columns:</b>
                    <input v-model="cols" type="number" />
                </div>

                <span>
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
                </span>
                <span>
                    <button class="panel-btn" @click="saveSheet">Save Sheet</button>
                    <button class="btn" @click="prevPage">&laquo;</button>
                    <button class="btn" @click="nextPage">&raquo;</button>
                    <!-- messages -->
                    <p v-if="success" style="color:green;">{{ success }}</p>
                    <p v-if="error" style="color:red;">{{ error }}</p>
                </span>
            </div>
            <em
                >select paper size and toggle one or more products to generate
                QR-codes on sheet</em
            >

            <div v-if="this.currentPaperFormat" id="sheet">
                <div :style="sheetBlueprint">
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
                            :dimensions="dimensions"
                        ></main-qr-item>
                    </div>
                </div>
            </div>
        </div>
        <code>{{ selectedProducts }}</code>
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
            alias: "",
            rows: 4,
            cols: 4,
            current_page: 1,
            max_pages: 1,
            currentPaperFormat: null,

            // messages
            success: null,
            error: null
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

        saveSheet() {
            const items = this.selectedProducts;

            if (!this.alias || this.alias == "") {
                this.error = "Alias is required";
            } 
            else if (!items || items.length < 1) {
                this.error = "Select at least one item!";
            } 
            else if (!this.currentPaperFormat) {
                this.error = "Please select some paper format!";
            } 
            else if (
                !(this.rows && this.cols) ||
                this.rows < 1 ||
                this.cols < 1
            ) 
            {
                this.error = "At least one row and column are required!";
            } 
            else {
                let data = {
                    alias: this.alias,
                    pages: this.max_pages,
                    page_width_mm: parseInt(
                        this.currentPaperFormat.split("x")[0]
                    ),
                    page_height_mm: parseInt(
                        this.currentPaperFormat.split("x")[1]
                    ),
                    rows_per_page: this.rows,
                    cols_per_page: this.cols,
                    product_amount: items.length,
                    items: items
                };

                axios
                    .post("/api/qrsheets", data)
                    .then(res => {
                        this.success = res.data.success;
                    })
                    .catch(err => {
                        this.error = err.response.data.error;
                    });
            }
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
                    top: 0,
                    left: 0,
                    width: `${paperWidth}mm`,
                    height: `${paperHeight}mm`,
                    display: "flex",
                    flexWrap: "wrap",
                    alignContent: "flex-start",
                    padding: `12mm`,
                    border: "1px solid red"
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
        },

        dimensions() {
            if (this.currentPaperFormat) {
                var paperWidth = parseInt(
                    this.currentPaperFormat.split("x")[0]
                );
                var paperHeight = parseInt(
                    this.currentPaperFormat.split("x")[1]
                );

                return {
                    height: Math.round((paperHeight - 12) / this.rows) - 2,
                    width: Math.round((paperWidth - 12) / this.cols) - 2,
                    qrRatio: 0.8
                };
            }
        }
    }
};
</script>
