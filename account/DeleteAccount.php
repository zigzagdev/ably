<?php
  include('../config/Constants.blade.php');

  $account_id= $_GET['account_id'];

$sql= "DELETE FROM tbl_account WHERE account_id=$account_id";
$rec= mysqli_query($connect, $sql);

if($rec == TRUE) {
    $_SESSION['add'] = "<div class='success'>Delete Account Successfully.</div>";
    $url = "http://localhost:8001/account/Login.blade.php";
    header('Location:' .$url,true , 302);
}
else
{
    $_SESSION['add'] = "<div class='error'>Failed to Add Admin.</div>";
    $url = "http://localhost:8001/account/ManageAccount.php?id=$account_id";
    header('Location:' .$url,true , 401);
}
?>