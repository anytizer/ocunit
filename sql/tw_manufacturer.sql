CREATE TABLE `tw_manufacturer`
(
    `manufacturer_id` int(11)      NOT NULL AUTO_INCREMENT,
    `name`            varchar(255) NOT NULL,
    `image`           varchar(255) NOT NULL,
    `email`           varchar(255) NOT NULL,
    `password_hash`   varchar(255) DEFAULT NULL,
    `status`          varchar(255) NOT NULL,
    PRIMARY KEY (`manufacturer_id`),
    UNIQUE KEY `email` (`email`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;