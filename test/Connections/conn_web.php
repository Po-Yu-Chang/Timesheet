<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conn_web = "localhost";
$database_conn_web = "web";
$username_conn_web = "root";
$password_conn_web = "eti@1234";
$conn_web = mysql_pconnect($hostname_conn_web, $username_conn_web, $password_conn_web) or trigger_error(mysql_error(),E_USER_ERROR); 
//資料庫連線設定使用UTF8編碼
mysql_query("SET NAMES UTF8");
//全站啟用session功能(有使用連線設定檔的頁面)
session_start();
?>