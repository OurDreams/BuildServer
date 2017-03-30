-- phpMyAdmin SQL Dump
-- version 3.4.10-rc1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 10 月 01 日 22:14
-- 服务器版本: 5.5.28
-- PHP 版本: 5.4.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `student`
--

-- --------------------------------------------------------

--
-- 表的结构 `student_information`
--
-- insert into buildlist(svn_url,svn_version,show_version,bsp_version,os_version,meter_version,oem,time
CREATE TABLE IF NOT EXISTS `build_information` (
  `build_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE KEY,
  `svn_url` char(255) COLLATE utf8_bin NOT NULL,
  `svn_ver` int(9) UNSIGNED NOT NULL,
  `release_ver` char(64) COLLATE utf8_bin NOT NULL,
  `show_ver` char(15) COLLATE utf8_bin NOT NULL,
  `bsp_ver` char(20) COLLATE utf8_bin NOT NULL,
  `kernel_ver` char(20) COLLATE utf8_bin NOT NULL,
  `meter_ver` char(20) COLLATE utf8_bin NOT NULL,
  `oem_ver` char(20) COLLATE utf8_bin NOT NULL,
  `boot_type` char(20) COLLATE utf8_bin NOT NULL,
  `boot_size` char(20) COLLATE utf8_bin NOT NULL,
  `app_size` char(20) COLLATE utf8_bin NOT NULL,
  `build_note` char(255) COLLATE utf8_bin NOT NULL,

  `user_name` char(64) COLLATE utf8_bin NOT NULL,
  `user_ip` char(15) COLLATE utf8_bin NOT NULL DEFAULT '0.0.0.0',

  `status` char(20) COLLATE utf8_bin NOT NULL,
  `err_brief` char(255) COLLATE utf8_bin NOT NULL,
  `commit_time` datetime DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `finsh_time` datetime DEFAULT NULL,
  `out_zip_url` char(255) COLLATE utf8_bin NOT NULL,
  `err_log_url` char(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;


