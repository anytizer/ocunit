-- Create manufacturer price log
CREATE TABLE `tw_manufacturer_prices`
(
    `manufacturer_price_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `manufacturer_id`       BIGINT(20)          NOT NULL,
    `product_id`            BIGINT(20)          NOT NULL,
    `product_price`         DOUBLE(8, 2)        NOT NULL DEFAULT 0.00,
    PRIMARY KEY (`manufacturer_price_id`),
    UNIQUE KEY `product_id_manufacturer_id` (`product_id`, `manufacturer_id`)
) ENGINE = InnoDB DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;