<?php

//initializing connection
$host=" ";
$dbuser=" ";
$dbpassword=" ";
$dbname=" ";

//connecting to database

$connect= mysql_connect($host, $dbuser, $dbpassword) or die("couldnot connect to database");
mysql_select_db($dbname, $connect) or die("mysql error")
?>
