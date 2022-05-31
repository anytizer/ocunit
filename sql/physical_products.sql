SELECT product_id, price
FROM `oc_product`
WHERE tax_class_id != 10
  AND price < 0.01