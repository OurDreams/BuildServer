<?php
require_once('config.php');
//连库
 $con=mysql_connect(HOST, USERNAME, PASSWORD);
  
//选库
mysql_select_db('buildserver');

//字符集
  mysql_query('set names utf8_bin');
?>