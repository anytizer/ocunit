CREATE TABLE `tw_login_failures` (
  `login_failure_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login_username` VARCHAR(255) NOT NULL,
  `login_date` DATETIME NOT NULL,
  `login_ip` VARCHAR(255) NOT NULL,
  `login_broser` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`login_failure_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;