-- Proce change history

CREATE TABLE `tw_price_history` (
  `history_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` BIGINT(20) NOT NULL,
  `product_price` DOUBLE(8,2) NOT NULL DEFAULT 0.00,
  `date_added` DATETIME DEFAULT NULL,
  PRIMARY KEY (`history_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;