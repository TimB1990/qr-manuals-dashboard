<template>
    <div class="menu-root">
        <div v-if="this.isLoading" class="loading">
            <span class="loader"></span>
        </div>

        <div v-if="this.notFound && !this.isLoading" class="notfound">
            <p>No product found</p>
        </div>

        <table class="panel-table" v-if="this.product.length > 0">
            <tr>
                <td class="menu-header">
                    <p id="product">
                        {{ this.product[0].name }}
                        <i id="stock" class="fa fa-check-circle"></i>
                    </p>
                    Artnr: {{ this.$route.params.artnr }}
                </td>
            </tr>
            <tr>
                <td class="menu-category">
                    <i class="fas fa-book"></i>
                    Documentation
                </td>
            </tr>

            <tbody v-if="this.manuals && this.manuals.length > 0">
                <tr v-for="manual in this.manuals" :key="manual.id">
                    <td class="menu-item">
                        <a :href="manual.file_url"
                            >{{
                                manual.file_name.substring(
                                    0,
                                    manual.file_name.length - 4
                                )
                            }}
                            (pdf)</a
                        >
                        <i class="fa fa-chevron-right"></i>
                    </td>
                </tr>
            </tbody>

            <tbody v-else>
                <tr>
                    <td class="menu-item">No manuals attached</td>
                </tr>
            </tbody>

            <tr>
                <td class="menu-category">
                    <i class="fa fa-box-open"></i>
                    Product
                </td>
            </tr>
            <tr>
                <td @click="gotoQuoteform" class="menu-item">
                    Request a quote
                    <i class="fa fa-chevron-right"></i>
                </td>
            </tr>
            <tr>
                <td class="menu-item">
                    Order product online
                    <i class="fa fa-chevron-right"></i>
                </td>
            </tr>
            <tr>
                <td @click="gotoScanner" v-if="!this.isLoading" class="menu-item">
                  Scan another product
                  <i class="fa fa-chevron-right"></i>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
export default {
    name: "viewpanel",
    data() {
        return {
            product: [],
            manuals: [],
            isLoading: true,
            notFound: true
        };
    },

    created() {
        this.setProductManuals(this.$route.params.artnr);
    },

    methods: {
        gotoScanner() {
            this.$router.push({ path: "/productpage" });
        },

        async setProductManuals(artnr) {
            // axios.get(`/api/products/${artnr}`)
            try {
                const product = await axios.get(`api/products/${artnr}`);

                const manuals = await axios.get(
                    `/api/products/${product.data[0].id}/manuals`
                );

                if (product.data.length > 0) {
                    this.isLoading = false;
                    this.notFound = false;
                    this.product = product.data;
                    this.manuals = manuals.data;
                } else {
                    this.isLoading = false;
                    this.notFound = true;
                }
            } catch (error) {
                this.isLoading = false;
                console.log(error);
            }
        },

        gotoQuoteform() {
            this.$router.push({
                name: "quote",
                query: {
                    id: this.product[0].id,
                    artnr: this.product[0].artnr,
                    name: this.product[0].name
                }
            });
        }
    }
};
</script>
