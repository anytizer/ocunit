-- Single sql file for generating inventory report.
-- Used within phpunit test script.
SELECT
    p.product_id,
    cd.name cname,
    p.model,
    p.sku,
    pd.name,
    p.status enabled,
    m.`name` vname,
    mp.product_price vprice,
    p.price,
    p.price - mp.product_price profit,
    p.quantity stock,
    p.minimum,
    p.shipping,
    p.subtract,
    p.tax_class_id,
    p.width, p.length, p.height, p.length_class_id,
    p.weight, p.weight_class_id,
    p.image
FROM oc_product p
INNER JOIN oc_product_description pd ON pd.product_id = p.product_id
INNER JOIN oc_product_to_category pc ON pc.product_id = p.product_id
INNER JOIN oc_category c ON c.category_id = pc.category_id
INNER JOIN oc_category_description cd ON cd.category_id = c.category_id
LEFT OUTER JOIN tw_manufacturer_prices mp ON mp.product_id = p.product_id
LEFT OUTER JOIN oc_manufacturer m ON m.manufacturer_id = mp.manufacturer_id
ORDER BY
    c.parent_id,
    cd.name,
    p.model,
    pd.name
;