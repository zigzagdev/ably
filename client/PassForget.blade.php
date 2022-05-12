<?php
include('../account/partials/ClientHeader.blade.php');
include "../config/Constants.blade.php";

if(isset($_SESSION['']))
{
  echo  $_SESSION[''];
  unset($_SESSION['']);
}

if(isset($_GET['client_id']))
{
  $client_id = $_GET['client_id'];
  $sql = "SELECT password FROM tbl_client WHERE client_id=$client_id";
  $rec = mysqli_query($connect, $sql);

  if ($rec == true)
  {
    $count = mysqli_num_rows($rec);
    if ($count == 1)
    {
      $row = mysqli_fetch_assoc($rec);
      $nowpassword = $row['password'];
    } else
    {
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }
}
?>
<html>
<head>
  <title>UpdatePassword</title>
  <link rel="stylesheet" href="../css/Account.css">
  <link rel="stylesheet" href="../css/Forms.css">
</head>
<body>
<div style="margin: 0 230px">
  <div class="mainaccount">
    <h1 style="text-align: center; margin: 55px 0 50px 0; padding-top: 20px">Update your Password</h1>
    <form action="" method="post" enctype="multipart/form-data" style="">
      <li style="list-style: none;  margin:17px 0 17px 30px">
        <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
          CurrentPassword
        </b>
        <input type="password" name="current" size="40">
      </li>
      <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
      <li style="list-style: none;  margin:17px 0 17px 30px">
        <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
          NewPassword
        </b>
        <input type="password" name="password" size="40">
      </li>
      <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
      <li style="list-style: none;  margin:17px 0 17px 30px">
        <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
          NewPasswordAgain
        </b>
        <input type="password" name="password2" size="40">
      </li>
      <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
      <div style="text-align: center; margin-top: 30px">
        <input type="submit" name="submit" value="Update your Account" class="btn-secondary">
        <button type="button" onclick=history.back() class="btn-secondary">Return</button>
      </div>
    </form>
  </div>
</div>
</body>
</html>