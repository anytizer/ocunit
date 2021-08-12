-- Create manufacturer price

CREATE TABLE `tw_manufacturer_prices` (
  `manufacturer_price_id` BIGINT(20) NOT NULL,
  `manufacturer_id` BIGINT(20) NOT NULL,
  `product_id` BIGINT(20) NOT NULL,
  `product_price` DOUBLE(8,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`manufacturer_price_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;