// create quotation
const quoteCreateBody  = {
   productID: 1,
   amount: 13,
	email: "test@mail.com",
	company: "test company",
	contact: "Tim Tester",
	address: "Torenallee 45 7.13",
	post_code: "5617 BA",
	city: "Eindhoven",
	country: "Netherlands",
	phone: "040 402 11 88",
}

// update quotation
const quoteUpdateBody = {
   status = "accepted"
}

// .quotes/id/specification
const priceSpecBody = {
   newUnitPrice: 250.00,
   tax: 0.21,
   shippingPerUnit: 4.00,
   shippingTax: 0.21
}

