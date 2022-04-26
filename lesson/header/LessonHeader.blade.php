<?php
include ('../config/Constants.blade.php');
  $sql = "SELECT * FROM tbl_account ";
  $rec = mysqli_query($connect, $sql);

  if($rec == TRUE)
  {
    $count = mysqli_num_rows($rec);
    if ($count >= 0)
    {
      while ($rows = mysqli_fetch_array($rec))
      {
        $account_id = $rows['account_id'];
      }
    }
  }
?>

<html>
  <head>
    <link rel="stylesheet" href="../../css/Account.css">
  </head>
  <body style="background-color: ghostwhite">
    <div class="infooutline">
      <div class="logo">
        <h1 class="hchar" style="color: #125EAE">Become a teacher..!</h1>
      </div>
      <div class="account text-center">
        <div class="wrapper">
          <a href = "../account/ManageAccount.php<?= $account_id ?>" style="text-decoration: none; color: black" class="wrapper-inner">Profile</a>
          <a href = "../DeleteLesson.php" style="text-decoration: none; color: black" class="wrapper-inner">DeleteLesson</a>
        </div>
      </div>
    </div>
  </body>
</html>