<?php
include "../config/Constants.blade.php";

$account_id= $_GET['account_id'];

$sql2= "DELETE FROM tbl_account WHERE account_id=$account_id";
$rec2= mysqli_query($connect, $sql2);

if($rec2 == TRUE)
{
  $_SESSION['delete_ac'] = "<div class='success'>Delete Account Successfully.</div>";
  header("Location:http://localhost:8001/Index.php", 302);
  exit();
} else
{
  $_SESSION['admin_failed'] = "<div class='error'>Failed to Add Admin.</div>";
  header("Location:http://localhost:8001/account/DeleteAccount.blade.php?account_id=$account_id", 401);
  die();
}
?>