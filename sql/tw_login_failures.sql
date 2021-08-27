CREATE TABLE `tw_login_failures` (
  `login_failure_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `login_datetime` datetime NOT NULL,
  `login_username` varchar(255) NOT NULL DEFAULT '',
  `login_ip` varchar(255) NOT NULL DEFAULT '',
  `login_browser` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`login_failure_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;