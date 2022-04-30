<?php
include ('../config/Constants.blade.php');
include ('../css/Account.css');
include ('../css/Forms.css');

session_start();
$_SESSION = array();

if (isset($_COOKIE["PHPSESSID"])) {
  setcookie("PHPSESSID", '', time() - 1800, '/');
}

session_destroy();
$_SESSION['ac_logout'] = "<div class='success'>Logout Successful.</div>";
header('Location:Index.php');
?>
