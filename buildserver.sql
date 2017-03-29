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
  `buildid` int(9) NOT NULL AUTO_INCREMENT,
  `svn_url` char(255) COLLATE utf8_bin NOT NULL,
  `svn_version` int(9)  NOT NULL,
  `release_version` char(64) COLLATE utf8_bin NOT NULL,
  `show_version` char(15) COLLATE utf8_bin NOT NULL,
  `meter_version` char(20) COLLATE utf8_bin NOT NULL,
  `bsp_version` char(20) COLLATE utf8_bin NOT NULL,
  `os_version` char(20) COLLATE utf8_bin NOT NULL,
  `oem` char(20) COLLATE utf8_bin NOT NULL,
  `brief` char(255) COLLATE utf8_bin NOT NULL,

  `who` char(64) COLLATE utf8_bin NOT NULL,
  `remote_ip` char(15) COLLATE utf8_bin NOT NULL DEFAULT '127.0.0.2',

  `status` char(20) COLLATE utf8_bin NOT NULL,
  `err_code` int(4)  NOT NULL,
  `commit_time` datetime DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `finsh_time` datetime DEFAULT NULL,
  UNIQUE KEY `buildid` (`buildid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;


