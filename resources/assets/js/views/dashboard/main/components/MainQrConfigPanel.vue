<template>
    <div>
        <div class="panel-layout content-root">
            <!-- layout header -->
            <div class="panel-layout-header">
                <router-link
                    v-if="this.$route.name == 'sheet-preview'"
                    :to="{ name: 'sheet-details', params: { id: qrsheet.id } }"
                    >Go Back</router-link
                >
                <span><b>Layout Blueprint</b> </span>
                <span>
                    <button class="btn" @click="prevPage">
                        &laquo;
                    </button>
                    page
                    {{
                        this.selectedProducts.length > 1 ? this.current_page : 1
                    }}
                    of {{ this.max_pages ? this.max_pages : 1 }}
                    <button class="btn" @click="nextPage">
                        &raquo;
                    </button>
                </span>
                <span>items per page: {{ page_size }}</span>
                <i
                    v-if="this.$route.name != 'sheet-preview'"
                    @click="toggleSettings"
                    style="font-size: 25px"
                    class="fas fa-cog"
                ></i>
            </div>

            <!-- content -->
            <div class="panel-content">
                <!-- configuration panel -->
                <div v-if="settings" class="config-panel">
                    <b>Settings</b>
                    <div>
                        <b>Alias:</b>
                        <input
                            ref="alias"
                            v-model="alias"
                            type="text"
                            placeholder="new sheet"
                        />
                    </div>

                    <div>
                        <b>Rows:</b>
                        <input v-model="rows" type="number" />
                    </div>

                    <div>
                        <b>Columns:</b>
                        <input v-model="cols" type="number" />
                    </div>

                    <div>
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

                    <span>
                        <!-- messages -->
                        <p v-if="success" style="color:green;">
                            {{ success }}
                        </p>
                        <p v-if="error" style="color:red;">{{ error }}</p>
                    </span>

                    <button @click="saveSheet">
                        <span v-if="this.$route.name == 'sheet-edit'"
                            >Update Sheet</span
                        >
                        <span v-if="this.$route.name == 'sheet-new'"
                            >Save Sheet</span
                        >
                    </button>
                </div>

                <!-- end configuration panel -->

                <!-- sheet preview panel -->
                <div class="preview-container">
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
                                    v-for="(item, index) in paginated()"
                                    :key="index"
                                    :id="item.id"
                                    :artnr="item.artnr"
                                    :kind="item.kind"
                                    :dimensions="dimensions"
                                ></main-qr-item>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end sheet preview panel -->
            </div>
            <!-- end content-panel -->
        </div>
    </div>
</template>

<script>
import MainQrItem from "./MainQrItem";

export default {
    name: "mainQrConfigPanel",
    components: { MainQrItem },

    created() {

        if (this.$route.name != "sheet-new") {
            this.loadSheetContents(this.$route.params.id);
        }
    },

    data() {
        return {
            settings: false,

            // content
            alias: "",
            rows: 4,
            cols: 4,
            current_page: 1,
            max_pages: 1,
            currentPaperFormat: "210x297",
            itemCopies: 1,

            // confirmation messages
            success: null,
            error: null
        };
    },

    methods: {
        toggleSettings() {
            this.settings = !this.settings;
        },

        toggleProducts() {
            this.$store.dispatch("toggleSideMenu", {
                show: null
            });
        },

        loadSheetContents(id) {
            // dispatch action to get qr sheet
            this.$store.dispatch("fetchQrSheet", {
                sheet_id: id
            });

            // clear current selected products
            this.$store.dispatch("clearSelected");

            // get sheet
            let sheet = this.qrsheet;

            // set settings according to sheet
            this.alias = sheet.alias;
            this.rows = sheet.rows_per_page;
            this.cols = sheet.cols_per_page;
            this.current_page = 1;
            this.max_pages = sheet.pages;
            this.currentPaperFormat = `${sheet.page_width_mm}x${sheet.page_height_mm}`;

            // add items from sheet model to selection
            let data = [];

            for (let i = 0; i < sheet.items.length; i++) {
                data = [
                    ...data,
                    {
                        id: sheet.items[i].id,
                        artnr: sheet.items[i].artnr,
                        kind: sheet.items[i].kind
                    }
                ];
            }

            this.$store.dispatch("addSelectedProduct", { data: data });
        },

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
            } else if (!items || items.length < 1) {
                this.error = "Select at least one item!";
            } else if (!this.currentPaperFormat) {
                this.error = "Please select some paper format!";
            } else if (
                !(this.rows && this.cols) ||
                this.rows < 1 ||
                this.cols < 1
            ) {
                this.error = "At least one row and column are required!";
            } else {
                this.error = null;
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
            let page_size = this.rows * this.cols;
            let paginated = this.$store.getters.paginatedSelection(
                this.current_page,
                page_size
            );
            this.max_pages = Math.ceil(
                this.selectedProducts.length / page_size
            );
            return paginated[0].items;
        }
    },

    computed: {
        selectedProducts() {
            return this.$store.state.selectedProducts;
        },

        storedItemCopies() {
            return this.$store.state.storedItemCopies;
        },

        page_size() {
            return this.rows * this.cols;
        },

        qrsheet() {
            return this.$store.state.qrsheet;
        },

        sheetDimensions() {
            return {
                width: parseInt(this.currentPaperFormat.split("x")[0]),
                height: parseInt(this.currentPaperFormat.split("x")[1])
            };
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
                    padding: `12mm`
                    // border: "1px solid red"
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
                    border: "1px dashed black"
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
        },

        prevScale() {
            if (this.sheetDimensions) {
                let dim = this.sheetDimensions;
                let paperAreaSize = dim.width * dim.height;

                let scale = (210 * 297) / paperAreaSize;

                if (scale <= 1) {
                    scale = scale;
                } else {
                    scale = 1.0;
                }

                return scale;
            }
        }
    }
};
</script>
