DELIMITER //
CREATE PROCEDURE requestQuotation(
   IN email VARCHAR(255),
   IN company VARCHAR(255),
   IN contact VARCHAR(255),
   IN address VARCHAR(255),
   IN post_code VARCHAR(10),
   IN city VARCHAR(255),
   IN phone VARCHAR(255),
   IN productid BIGINT(20) unsigned,
   IN amount INT(4)

)

DECLARE customerid BIGINT(20) unsigned;
DECLARE quotationProductId BIGINT(20) unsigned;
DECLARE quotationid BIGINT(20) unsigned;

BEGIN
-- insert contact data
INSERT INTO customers (customers.email, customers.company, customers.contact, customers.address, customers.post_code, customers.city, customers.phone)
VALUES (email, company, contact, address, post_code, city, phone);

-- retrieve and set customerid
SET customerid = (SELECT id FROM customers WHERE customers.email = email);

-- create temporary table for quotation_producs to be updated by data within this procedure
CREATE TEMPORARY TABLE temp_quotation_products(orgin_id BIGINT(20) unsigned, quote_id BIGINT(20) unsigned, unit_price FLOAT(8,2), artnr VARCHAR(255), name VARCHAR(255), kind VARCHAR(255));

-- retrieve and set quotationProductId
SET quotationProductid = (SELECT id FROM temp_quotation_products WHERE origin_id = productid);

-- insert product data in temporary table
INSERT INTO temp_quotation_products(origin_id, unit_price, artnr, name, kind)
SELECT (p.id, p.unit_price, p.artnr, p.name, p.kind) FROM products p WHERE p.id = productid;

-- create temporary table for quotations to be used in this procedure
CREATE TEMPORARY TABLE temp_quotations(id BIGINT(20) unsigned auto_increment, customer_id BIGINT(20) unsigned, quotation_product_id BIGINT(20) unsigned, amount INT(4), status enum("pending","accepted","processed","approved","review", "denied"), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, primary key(id));

-- insert quotation data
INSERT INTO temp_quotations tq (tq.customer_id, tq.quotation_product_id, tq.amount, tq.status)
VALUES (customerid, quotationProductid, amount, "pending");

-- retrieve and set quotationId
SET quotationid = (SELECT id FROM temp_quotations WHERE customer_id = customerid AND quotation_product_id = quotationProductid);

-- update temp_quotations_products' quote_id field
UPDATE temp_quotations_products SET quote_id = quotationid WHERE customer_id = customerid AND quotation_product_id = quotationProductid);

-- insert temporary data in official quotation_products table
INSERT INTO quotation_products qp (qp.origin_id, qp.quote_id, qp.unit_price, qp.artnr, qp.name, qp.kind)
SELECT (origin_id, quote_id, unit_price, artnr, name, kind) FROM temp_quotation_products WHERE quote_id = quotationid;

-- insert all from temp_quotations into quotations
INSERT INTO quotations SELECT * FROM temp_quotations;

-- drop both temporary tables
DROP TABLE temp_quotation_products; DROP table temp_quotations;

END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE create_price_specification (
   IN new_unit_price FLOAT(6,2),
   IN tax_percentage FLOAT (3,2),
   IN shipping_per_unit FLOAT (6,2),
   IN shipping_tax_percentage FLOAT (3,2),
   IN quote_id BIGINT(20) unsigned
)
-- declare variables
DECLARE original_unit_price, total_price, discount, tax, shipping_tax, final_total FLOAT(9,2);
DECLARE quotation_amount INT(4); 
--
BEGIN
SET original_unit_price = (
   SELECT unit_price
   FROM quotation_products qp
   WHERE qp.quote_id = quote_id
);

SET quotation_amount = (
   SELECT amount
   FROM quotations
   WHERE quotations.id = quote_id
)

SET total_price = new_unit_price * quotation_amount;
SET discount = (original_unit_price * quotation_amount) - total_price;
SET tax = total_price * tax_percentage
SET shipping_tax = shipping_per_unit * quotation_amount * shipping_tax_percentage;
SET final_total = total_price + tax + (shipping_per_unit * quotation_amount) + shipping_tax;

-- insert records into priceSpec
INSERT INTO price_specifications (quote_id, new_unit_price, total, discount, tax, shipping_per_unit, shipping_tax, final_total) VALUES (quote_id, new_unit_price, total_price, discount, tax, shipping_tax, final_total);

END //
DELIMITER ;


