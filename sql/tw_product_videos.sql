CREATE TABLE `tw_product_videos`
(
    `video_id`   bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `product_id` bigint(20) unsigned NOT NULL,
    `video_code` varchar(255)        NOT NULL,
    `video_link` varchar(255)        NOT NULL,
    PRIMARY KEY (`video_id`)
) ENGINE = InnoDB DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;