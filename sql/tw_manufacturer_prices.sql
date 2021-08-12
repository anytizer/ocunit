-- Create manufacturer price

CREATE TABLE `tw_manufacturer_prices` (
  `manufacturer_price_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `manufacturer_id` BIGINT(20) NOT NULL,
  `product_id` BIGINT(20) NOT NULL,
  `product_price` DOUBLE(8,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`manufacturer_price_id`),
  UNIQUE KEY `product_id_manufacturer_id` (`product_id`,`manufacturer_id`)
) ENGINE=INNODB ADEFAULT CHARSET=utf8mb4;