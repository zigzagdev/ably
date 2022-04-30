<?php
include ('../config/Constants.blade.php');
include ('../css/Account.css');


session_start();
$_SESSION = array();

if (isset($_COOKIE["PHPSESSID"])) {
  setcookie("PHPSESSID", '', time() - 1800, '/');
}

session_destroy();
$_SESSION['ac_logout'] = "<div class='success'>Logout Successful.</div>";
header('Location:Login.blade.php');
?>
