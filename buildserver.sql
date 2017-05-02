
CREATE TABLE IF NOT EXISTS `build_information` (
  `build_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE KEY,
  `svn_url` varchar(255) COLLATE utf8_bin NOT NULL,
  `svn_ver` int(9) UNSIGNED NOT NULL,
  `release_ver` varchar(64) COLLATE utf8_bin NOT NULL,
  `show_ver` varchar(15) COLLATE utf8_bin NOT NULL,
  `bsp_ver` varchar(20) COLLATE utf8_bin NOT NULL,
  `kernel_ver` varchar(20) COLLATE utf8_bin NOT NULL,
  `meter_ver` varchar(20) COLLATE utf8_bin NOT NULL,
  `oem_ver` varchar(20) COLLATE utf8_bin NOT NULL,
  `boot_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `boot_size` varchar(20) COLLATE utf8_bin NOT NULL,
  `app_size` varchar(20) COLLATE utf8_bin NOT NULL,
  `build_note` varchar(512) COLLATE utf8_bin NOT NULL,

  `user_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `user_ip` varchar(15) COLLATE utf8_bin NOT NULL DEFAULT '0.0.0.0',

  `status` char(20) COLLATE utf8_bin NOT NULL,
  `err_count` int(3) UNSIGNED NOT NULL DEFAULT '0',
  `commit_time` datetime DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `finsh_time` datetime DEFAULT NULL,
  `out_zip_url` varchar(255) COLLATE utf8_bin NOT NULL,
  `err_log_url` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


