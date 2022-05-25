<?php
include ('../config/Constants.blade.php');

session_start();

$_SESSION = array();

if (isset($_COOKIE["PHPSESSID"])) {
  setcookie("PHPSESSID", '', time() - 1800, '/');
}

session_destroy();
$_SESSION['ac_logout'] = "<div style='text-align: center;font-size: 20px;color: #ff6666 '>Logout Successful.</div>";
header('Location:http:/Index.php');
die();
?>
