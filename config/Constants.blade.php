<?php

session_start();


define('SITEURL', 'localhost:8001');
define('LOCALHOST', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'overcome');

$connect = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database Connection
$db_select = mysqli_select_db($connect, DB_NAME) or die(mysqli_error($connect)); //SElecting Database

?>