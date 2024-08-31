<?php

//initializing connection
$host="sql105.epizy.com";
$dbuser="epiz_29213143";
$dbpassword="Hh8MGJialQ";
$dbname="epiz_29213143_abs";

//connecting to database

$connect= mysql_connect($host, $dbuser, $dbpassword) or die("couldnot connect to database");
mysql_select_db($dbname, $connect) or die("mysql error")
?>