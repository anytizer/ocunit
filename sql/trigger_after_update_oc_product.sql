-- Before installing trigger
INSERT INTO tw_price_history (product_id, product_price, date_added) SELECT product_id, price, NOW() FROM oc_product;

DROP TRIGGER IF EXISTS trigger_after_update_oc_product;

DELIMITER $$
CREATE TRIGGER trigger_after_update_oc_product AFTER UPDATE ON oc_product FOR EACH ROW
BEGIN
	IF old.price <> new.price THEN
		INSERT INTO tw_price_history (product_id, product_price, date_added) VALUES(new.product_id, new.price, NOW());
	END IF;
END$$
