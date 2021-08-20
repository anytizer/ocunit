CREATE TABLE `tw_login_failures` (
  `login_failure_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `login_username` varchar(255) NOT NULL,
  `login_ip` varchar(255) NOT NULL,
  `login_date` datetime NOT NULL,
  PRIMARY KEY (`login_failure_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;