TRUNCATE TABLE oc_stock_status;

INSERT INTO `oc_stock_status` (`stock_status_id`, `language_id`, `name`)
VALUES
	(1, 1, 'In Stock'),
	(2, 1, 'Pre-Order'),
	(3, 1, 'Out Of Stock'),
	(4, 1, '2-3 Days')
;
