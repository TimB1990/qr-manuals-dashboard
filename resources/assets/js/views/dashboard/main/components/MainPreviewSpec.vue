<template>
    <div class="preview-root">
        <p><b>Customer information</b></p>

        <table class="preview-content">
            <tr>
                <td>Company:</td>
                <td style="text-align: right;">{{ this.customer.company}}</td>
            </tr>
            <tr>
                <td>Contact:</td>
                <td style="text-align: right;">{{ this.customer.contact }}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td style="text-align: right;">
                    {{ this.customer.email}}
                </td>
            </tr>
            <tr>
                <td>Phone</td>
                <td style="text-align: right;">
                    <span v-if="this.customer.phone">{{ this.customer.phone }}</span>
                    <span v-else>No phone number provided</span>
                </td>
            </tr>
            <tr>
                <td>Address:</td>
                <td style="text-align: right;">
                    {{ this.customer.address}}
                </td>
            </tr>
            <tr>
                <td>Postcode:</td>
                <td style="text-align: right;">
                    {{ this.customer.post_code}}
                </td>
            </tr>
            <tr>
                <td>Residence:</td>
                <td style="text-align: right;">
                    {{ this.customer.residence }}
                </td>
            </tr>
        </table>

        <p><b>Product Information</b></p>
        <table class="preview-content">
            <tr>
                <td>Name</td>
                <td style="text-align: right;">
                    {{ this.queryObject.productname }}
                </td>
            </tr>
            <tr>
                <td>Artnr</td>
                <td style="text-align: right;">
                    {{ this.queryObject.artnr }}
                </td>
            </tr>
            <tr>
                <td>Amount</td>
                <td style="text-align: right;">
                    {{ this.queryObject.amount }}
                </td>
            </tr>
        </table>

        <p><b>Price Specification</b></p>

        <table class="preview-content">
            <tr>
                <td>Subtotal</td>
                <td style="text-align:right;" colspan="2">&euro; {{ this.queryObject.subtotal }}</td>
            </tr>
            <tr>
                <td>Discount</td>
                <td>{{this.queryObject.pdiscount}}%</td>
                <td style="text-align:right;">&euro; {{ this.queryObject.discount }}</td>
            </tr>
            <tr>
                <td>Tax</td>
                <td>{{ this.queryObject.ptax }}%</td>
                <td style="text-align:right;">&euro; {{ this.queryObject.tax}}</td>
            </tr>
            <tr>
                <td>Shipping</td>
                <td colspan="2" style="text-align:right;">&euro; {{ this.queryObject.shipping }}</td>
            </tr>
            <tr>
                <td>Shipping Tax</td>
                <td>{{ this.queryObject.pshiptax }}%</td>
                <td style="text-align:right;">&euro; {{ this.queryObject.shippingtax}}</td>
            </tr>
            <br />
            <tr>
                <td><b>Total</b></td>
                <td colspan="2" style="text-align:right;">
                    <b>&euro; {{ this.queryObject.total }}</b>
                </td>
            </tr>
        </table>

        <div class="btn-panel">
            <button class="btn">Save specification</button>
            <button class="btn">Email customer</button>
        </div>
        <p><em style="color:red;">Not yet implemented</em></p>
    </div>
</template>

<script>

export default {
    name: "mainPreviewPriceSpec",
    created(){
        this.fetchQuoteCustomerOnly()
    },
    methods: {
        fetchQuoteCustomerOnly(){
            this.$store.dispatch('fetchQuoteCustomerOnly', {
                quote_id: this.$route.params.id
            })
        }
    },
    computed: {
        customer(){
            return this.$store.state.quoteCustomer
        },
        queryObject(){
            let query = this.$route.query
            return {
                productname: query.productname,
                artnr: query.artnr,
                amount: query.amount,
                subtotal: parseFloat(query.subtotal).toFixed(2),
                discount: (0 - parseFloat(query.discount)).toFixed(2),
                pdiscount: parseFloat(query.pdiscount).toFixed(2),
                tax: parseFloat(query.tax).toFixed(2),
                ptax: (query.ptax * 100).toFixed(2),
                shipping: parseFloat(query.shipping).toFixed(2),
                shippingtax: parseFloat(query.shippingtax).toFixed(2),
                pshiptax: (query.pshiptax * 100).toFixed(2),
                total: parseFloat(query.total).toFixed(2) 
            }
        },
    }
};
</script>

<style scoped>
.preview-root {
    display: flex;
    justify-content: center;
    flex-direction: column;
    padding: 1rem;
    border-radius: 6px;
    box-shadow: 0 0.5em 1em -0.125em rgba(10, 10, 10, 0.1),
        0 0px 0 1px rgba(10, 10, 10, 0.02);
    
}

.preview-content {
    width: 70%;
    border: 1px dashed grey;
    padding: 0.75rem;

}

.btn-panel {
    margin-top: 2rem;
    display: flex;
    padding: 1rem;
}

.btn {
    display: inline-block;
    margin: 3px 3px 3px 3px;
    background-color: transparent;
    border: 1px solid hsl(0, 0%, 76%);
    padding: 0.5rem 1rem;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    outline: none;
}

.btn:hover {
    border: 1px solid black;
    background-color: hsl(0, 0%, 96%);
}
</style>
