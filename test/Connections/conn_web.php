<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conn_web = "localhost";
$database_conn_web = "web";
$username_conn_web = "root";
$password_conn_web = "eti@1234";
$conn_web = mysql_pconnect($hostname_conn_web, $username_conn_web, $password_conn_web) or trigger_error(mysql_error(),E_USER_ERROR); 
//��Ʈw�s�u�]�w�ϥ�UTF8�s�X
mysql_query("SET NAMES UTF8");
//�����ҥ�session�\��(���ϥγs�u�]�w�ɪ�����)
session_start();
?>