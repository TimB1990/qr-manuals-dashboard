<template>
    <div class="content-root">
        <div class="panel-layout">
            <div class="config-panel">
                <em
                    >toggle one or more products to generate QR-codes on
                    sheet</em
                >
                <ul>
                    <li>paper format: A4</li>
                    <li>
                        page:
                        {{
                            this.selectedProducts.length > 1
                                ? this.current_page
                                : 1
                        }}
                        of {{ this.max_pages ? this.max_pages : 1 }}
                    </li>
                    <li>
                      items per page: {{ page_size }}
                    </li>
                </ul>
            </div>

            <div id="sheet" class="sheet">
                <div class="sheet__blueprint">
                    <div
                        v-for="n in page_size"
                        :key="n"
                        class="qr-item-blueprint"
                    ></div>
                    <div class="sheet__items">
                        <main-qr-item
                            v-for="item in paginated()"
                            :key="item.id"
                            :id="item.id"
                            :artnr="item.artnr"
                            :kind="item.kind"
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
            page_size: 25,
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

        pagesize(){
          return this.page_size;
        }
    }
};
</script>
