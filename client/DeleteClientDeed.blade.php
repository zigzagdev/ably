<?php
include "../config/Constants.blade.php";
$client_id= $_GET['client_id'];

$sql2= "DELETE FROM tbl_client WHERE client_id=$client_id";
$rec2= mysqli_query($connect, $sql2);

if($rec2 == TRUE) {
  $_SESSION['dlt_cli'] = "<div class='success'>Delete Account Successfully.</div>";
  header("Location:http://localhost:8001/Index.php");
  exit();
}
else
{
  $_SESSION['client_failed'] = "<div class='success'>Failed to delete Account.</div>";
  header("http:/localhost:8001/client/DeleteClient.php?client_id=$client_id");
  die();
}
?>
