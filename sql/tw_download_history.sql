CREATE TABLE `tw_download_history` (
    `history_id` varchar(40) NOT NULL,
    `user_id` varchar(255) NOT NULL DEFAULT '',
    `download_id` varchar(255) NOT NULL DEFAULT '',
    `download_on` varchar(255) NOT NULL DEFAULT '',
    PRIMARY KEY (`history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;