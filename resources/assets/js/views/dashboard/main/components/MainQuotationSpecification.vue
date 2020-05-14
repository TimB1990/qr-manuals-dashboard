<template>
    <div class="spec-root">
        <div class="quote-spec-heading">
            Specify pricing
        </div>
        <div class="spec-form">
            <div class="input-container">
                <label for="p-name">product</label>
                <input
                    id="p-name"
                    type="text"
                    v-model="product_name"
                    disabled
                />
            </div>
            <div class="input-container">
                <label for="p-artnr">artnr</label>
                <input
                    id="p-artnr"
                    v-model="product_artnr"
                    type="text"
                    disabled
                />
            </div>
            <div class="input-container">
                <label for="p-amount">amount</label>
                <input v-model="amount" id="p-amount" type="text" disabled />
            </div>
            <div class="input-container">
                <label for="p-ppu">Orig. Unit Price</label>
                <input
                    v-model="origUnitPrice"
                    id="p-ppu"
                    type="text"
                    disabled
                />
                <span>EUR</span>
            </div>
            <div class="input-container">
                <label for="new-unit-price">New Unit Price</label>
                <input v-model="newUnitPrice" id="new-unit-price" type="text" />
                <span>EUR</span>
            </div>
            <div class="input-container">
                <label for="tax">tax</label>
                <input v-model="tax" id="tax" type="text" />
            </div>
            <div class="input-container">
                <label for="shipping-unit">Shipping Per Unit</label>
                <input v-model="shipUnitPrice" id="shipping-unit" type="text" />
                <span>EUR</span>
            </div>
            <div class="input-container">
                <label for="shipping-tax">Shipping Tax</label>
                <input
                    v-model="shipTax"
                    id="shipping-tax"
                    type="text"
                    value="0.21"
                />
            </div>
        </div>
        <div class="quote-spec-heading">
            Calculation
        </div>
        <div class="calc">
            <div class="input-container">
                <label for="c-total">Total</label>
                <input id="p-name" type="text" :value="this.total" disabled />
                <span>EUR</span>
            </div>
            <div class="input-container">
                <label for="c-tax-total">Tax total</label>
                <input id="c-tax-total" type="text" :value="this.taxTotal" disabled />
                <span>EUR</span>
            </div>
            <div class="input-container">
                <label for="c-ship-total">Shipping total</label>
                <input id="c-ship-total" type="text" :value="this.shipTotal" disabled />
                <span>EUR</span>
            </div>
            <div class="input-container">
                <label for="c-ship-tax-total">Ship Tax Total</label>
                <input id="c-ship-tax-total" type="text" :value="this.shipTaxTotal" disabled />
                <span>EUR</span>
            </div>
            <div class="input-container">
                <label for="c-final-total">Final total</label>
                <input id="c-final-total" type="text" :value="this.finalTotal" disabled />
                <span>EUR</span>
            </div>
            <div class="input-container">
                <label for="c-discount">Provided Discount</label>
                <input id="c-discount" type="text" :value="this.provDiscount" disabled />
                <span>EUR</span>
            </div>
                        <div class="input-container">
                <label for="c-discount-%">Discount Percentage</label>
                <input id="c-discount-%" type="text" :value="this.discountPercentage" disabled />
                <span>%</span>
            </div>
        </div>
        <div class="btn-panel">
            <button class="attach-btn">Attach to quotation</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "mainQuotationSpecification",
    created(){
       // window.addEventListener('scroll', this.detectScroll)
    },
    destroyed(){
       // window.removeEventListener('scroll', this.detectScroll)
    },
    data() {
        return {
            product_name: "Exalto 3932 RW",
            product_artnr: "211200.25",
            amount: 12,
            origUnitPrice: (255.5).toFixed(2),
            newUnitPrice: 0,
            tax: 0.21,
            shipUnitPrice: 0,
            shipTax: 0.21,
            // scroll: false
        };
    },
    computed: {
       total(){
          return this.amount * this.newUnitPrice
       },
       taxTotal(){
          return this.total * this.tax
       },
       shipTotal(){
          return this.amount * this.shipUnitPrice
       },
       shipTaxTotal(){
          return this.shipTotal * this.shipTax;
       },
       finalTotal(){
          return parseFloat(this.total + this.taxTotal + this.shipTotal + this.shipTaxTotal).toFixed(2)
       },
       provDiscount(){
          return (this.origUnitPrice * this.amount) - this.total
       },
       discountPercentage(){
          return ((this.provDiscount / (this.origUnitPrice * this.amount)) * 100).toFixed(1)
       }
      
    }
};
</script>
<style scoped>
.spec-root {
    padding: 0.75rem;
    border-radius: 6px;
    box-shadow: 0 0.5em 1em -0.125em rgba(10, 10, 10, 0.1),
        0 0px 0 1px rgba(10, 10, 10, 0.02);
}
.quote-spec-heading {
    color: white;
    background-color: rgb(204, 0, 51);
    padding: 0.5rem;
    border: 1px solid hsl(0, 0%, 76%);
}

.spec-form,
.calc {
    display: flex;
    flex-direction: column;
    padding: 1rem;
    border-left: 1px solid hsl(0, 0%, 76%);
    border-right: 1px solid hsl(0, 0%, 76%);
    border-bottom: 1px solid hsl(0, 0%, 76%);
    border-radius: 0px 0px 6px 6px;
    margin-bottom: 1rem;
}
.input-container {
    display: flex;
    justify-content: space-between;
    border: 1px solid hsl(0, 0%, 76%);
    padding: 0.5rem;
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}

.input-container > label,
.input-container > span {
    font-weight: bold;
    font-size: 14px;
    padding: 0.5rem;
}

.input-container > label {
    width: 10rem;
}
.input-container > input {
    flex: 1;
    padding: 0.25rem;
    border: 1px solid black;
    font-size: 14px;
    letter-spacing: .13rem;
}

.input-container > input:disabled {
    background-color: hsl(0, 0%, 96%);
    border: 1px solid hsl(0, 0%, 76%);
}

.attach-btn {
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

.attach-btn:hover {
    border: 1px solid black;
    background-color: hsl(0, 0%, 96%);
}

.btn-panel {
    display: flex;
    justify-content: center;
    padding: 1rem;
    border: 1px solid black;
}
</style>
