<?php include ('../config/Constants.blade.php');

$_SESSION = array();

if (isset($_COOKIE["PHPSESSID"])) {
  setcookie("PHPSESSID", '', time() - 1800, '/');
}

session_destroy();
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
