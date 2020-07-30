<template>
    <div>
        <div class="quote-panel">
            <p class="quote-title">Request Quotation</p>

            <div class="quote-head">
                <p>
                   <b>{{ this.artnr }}</b>
                    <!--<i id="stock" class="fa fa-check-circle"></i>-->
                </p>
                <p>{{ this.name }}</p>
            </div>

            <div class="form-content">
                <div class="field-container">
                    <i class="fas fa-building icon"></i>
                    <input
                        v-model="company"
                        type="text"
                        placeholder="Company / business"
                        required
                    />
                </div>
                <div class="field-container">
                    <i class="fas fa-id-card-alt icon"></i>
                    <input
                        v-model="contact"
                        type="text"
                        placeholder="Contact name"
                        required
                    />
                </div>
                <div class="field-container">
                    <i class="fas fa-at icon"></i>
                    <input v-model="email" type="text" placeholder="Email"
                    required
                     />
                </div>
                <div class="field-container">
                    <i class="far fa-address-card icon"></i>
                    <input
                        v-model="address"
                        type="text"
                        placeholder="address + house-nr."
                        required
                    />
                </div>
                <div class="field-container">
                    <i class="fas fa-map-marker-alt icon"></i>
                    <input
                        v-model="post_code"
                        type="text"
                        placeholder="post code"
                        required
                    />
                </div>
                <div class="field-container">
                    <i class="fas fa-city icon"></i>
                    <input v-model="residence" type="text" placeholder="city" required />
                </div>
                <div class="field-container">
                    <i class="fas fa-phone-alt icon"></i>
                    <input
                        v-model="phone"
                        id="phone"
                        type="tel"
                        placeholder="phone"
                    />
                </div>
            </div>

            <!-- amount panel -->
            <div class="amount-panel">
                <div>
                    <span><b>Pick Amount:</b></span>
                </div>
                <input
                    v-model="amount"
                    required
                    id="amount"
                    type="number"
                    placeholder="..."
                    min="1"
                    max="500"
                />
            </div>

            <!-- errors or confirmation -->
            <div class="message-panel">
                <p v-if="error" id="input-error"><i class="fas fa-exclamation-circle"></i><span>{{ error }}</span></p>
                <p v-if="confirmation" id="confirmation">
                    {{ confirmation }}
                </p>
            </div>
        </div>

        <!-- errors panel -->

        <!-- page footer -->
        <div class="page-footer panel">
            <button class="panel-btn" v-if="!this.submitDisabled" @click="goBackToPanel">
                Go back to panel
            </button>
            <button
                class="panel-btn
                "
                @click="processRequest"
                :disabled="submitDisabled"
            >
                <span>Confirm Request</span>
                <span v-if="processing">Processing request...</span>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "quoteform",
    data() {
        return {
            // product information
            product_id: null,
            artnr: null,
            name: null,

            // inputs
            company: null,
            contact: null,
            email: null,
            phone: "",
            address: null,
            post_code: null,
            residence: null,
            amount: null,

            // error
            error: null,

            // confirmation
            confirmation: null,

            // controls
            submitDisabled: false,
            processing: false
        };
    },
    created() {
        this.product_id = this.$route.query.id;
        this.artnr = this.$route.query.artnr;
        this.name = this.$route.query.name;
    },
    methods: {
        processRequest() {
            this.procesing = true;
            this.error = null;
            if (!this.company) {
                this.error = "Company / business field cannot be empty";
            }

            if (!this.contact) {
                this.error = "Contact name field cannot be empty";
            }

            if (this.phone.length > 0) {
                const regex = /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
                if (!regex.test(this.phone)) {
                    this.error = "phone number format not recognized";
                }
            }

            if (!this.address) {
                this.error = "Company Address is required";
            } else {
                const regex = /.*\d/;
                if (!regex.test(this.address))
                    this.error = "address field requires House nr. digit";
            }

            if (!this.post_code) this.error = "post code is required";

            if (!this.residence) this.error = "Residence is required";

            if (!this.amount) {
                this.error = "Some amount is required";
            } else {
                let amount = parseInt(this.amount);
                if (!(this.amount > 0 && this.amount <= 500)) {
                    this.error = "Some amount between 1 and 500 is required";
                }
            }

            if (!this.email) {
                this.error = "Email field cannot be empty";
            } else {
                const regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

                if (!regex.test(this.email)) {
                    this.error = "invalid email format";
                }
            }

            if (!this.error) {
                let input = {
                    product_id: this.product_id,
                    product_artnr: this.artnr,
                    company: this.company,
                    contact: this.contact,
                    email: this.email,
                    phone: this.phone,
                    // new fields
                    address: this.address,
                    post_code: this.post_code,
                    residence: this.residence,
                    amount: this.amount,
                    status: "pending"
                };

                this.processing = true

                axios
                    .post(`api/quotations`, input)
                    .then(response => {
                        this.processing = false
                        this.submitDisabled = true
                        this.confirmation =
                            "Thank you, your quote is being processed, please check your email for more information";
                    })
                    .catch(error => console.log(error));
            }
        },

        goBackToPanel() {
            this.$router.push({ name: 'view', params: {artnr:this.artnr} });
        }
    },

    computed: {
        hasError() {
            return this.error ? true : false;
        }
    }
};
</script>
