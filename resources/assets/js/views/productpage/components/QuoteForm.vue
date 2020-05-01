<template>
  <div>
    <div class="quote-panel">
      <p class="quote-title">Request A Quote</p>

      <div class="quote-head">
        <p>
          {{ this.artnr}}
          <i id="stock" class="fa fa-check-circle"></i>
        </p>
        <p>{{ this.name}}</p>
      </div>

      <div class="form-content">
        <div class="field-container">
          <i class="fas fa-building icon"></i>
          <input v-model="company" type="text" placeholder="Company / business *" />
        </div>
        <div class="field-container">
          <i class="fas fa-id-card-alt icon"></i>
          <input v-model="contact" type="text" placeholder="Contact name *" />
        </div>
        <div class="field-container">
          <i class="fas fa-at icon"></i>
          <input v-model="email" type="text" placeholder="Email *" />
        </div>
        <!-- new fields -->
        <div class="field-container">
          <i></i>
          <input v-model="address" type="text" placeholder="address" />
        </div>
        <div class="field-container">
          <i></i>
          <input v-model="nr" type="text" placeholder="house nr." />
        </div>
        <div class="field-container">
          <i></i>
          <input v-model="post_code" type="text" placeholder="post code" />
        </div>
        <div class="field-container">
          <i></i>
          <input v-model="residence" type="text" placeholder="residence" />
        </div>
        <!-- -->
        <div class="field-container">
          <i class="fas fa-phone-alt icon"></i>
          <input v-model="phone" id="phone" type="tel" placeholder="phone" />
        </div>
      </div>
      <div class="amount-stock-panel">
        <div>
          <span>amount</span>
          <input v-model="amount" id="amount" type="number" placeholder="..." min="1" max="500" />
        </div>
        <div>
          <span>stock: 1000</span>
        </div>
      </div>
      <p id="input-error" v-if="this.error">{{ this.error }}</p>
      <p id="confirmation" v-if="this.confirmation">{{ this.confirmation }}</p>
    </div>
    <div class="page-footer">
      <button v-if="!this.submitDisabled" @click="goBackToPanel">Go back to panel</button>
      <button id="confirm" @click="processRequest" :disabled="this.submitDisabled">
        <span v-if="!this.submitDisabled">Confirm Request</span>
        <span v-else>Processing request...</span>
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
      nr: null,
      post_code: null,
      residence: null,
      amount: null,

      // error
      error: null,

      // confirmation
      confirmation: null,

      // controls
      submitDisabled: false
    };
  },
  created() {
    this.product_id = this.$route.query.id;
    this.artnr = this.$route.query.artnr;
    this.name = this.$route.query.name;
  },
  methods: {
    processRequest() {
      this.submitDisabled = true;
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
      }

      if (!this.nr) {
        this.error = "House nr. is required!";
      } else {
        const regex = /.*\d/;
        if (!regex.test(this.nr)) this.error = "nr. requires digit";
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
          nr: this.nr,
          post_code: this.post_code,
          residence: this.residence,
          amount: this.amount,
          status: "pending"
        };

        axios
          .post(`api/quotations`, input)
          .then(response => {
            this.confirmation =
              "Thank you, your quote is being processed, please check your email for more information, you will be redirect in a few seconds...";
            var self = this;
            setTimeout(() => {
              self.goBackToPanel();
            }, 2000);
          })
          .catch(error => console.log(error));
      }
    },

    goBackToPanel() {
      this.$router.push({ path: `/view/${this.artnr}` });
    }
  },

  computed: {
    hasError() {
      return this.error ? true : false;
    }
  }
};
</script>

<style>
.quote-panel {
  margin-bottom: 24px;
  padding: 16px;
  background-color: white;
  box-shadow: 0 0.5em 1em -0.125em rgba(10, 10, 10, 0.1),
    0 0px 0 1px rgba(10, 10, 10, 0.02);
}

.quote-title {
  font-size: 20px;
  font-weight: bold;
}

.form-content {
  border: 1px solid hsl(0, 0%, 80%);
  padding: 12px;
}

.quote-head {
  border: 1px solid hsl(0, 0%, 80%);
  padding: 12px;
  margin-top: 12px;
  margin-bottom: 12px;
}

.amount-stock-panel {
  display: flex;
  align-items: center;
  justify-content: space-between;
  border: 1px solid hsl(0, 0%, 80%);
  padding: 12px;
  margin-top: 12px;
}

#amount {
  margin: 3px 6px 3px 6px;
  border: 1px solid hsl(0, 0%, 76%);
  text-align: center;
  color: black;
  /*border-radius: 6px;*/
  padding: 6px 12px 6px 12px;
  width: 60px;
  font-size: 14px;
  outline: none;
}

#confirm {
  background-color: #cc0033;
  color: white;
}

#confirm:disabled {
  color: hsl(0, 0%, 70%);
  background-color: hsl(0, 0%, 98%);
  pointer-events: none;
}

.field-container > input {
  font-size: 16px;
}

#required {
  font-size: 10px;
  padding: 4px;
}

#input-error {
  padding: 12px;
  color: red;
}
#confirmation {
  padding: 12px;
  color: green;
}
</style>

