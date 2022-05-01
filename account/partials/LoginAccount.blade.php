<?php
include ('../config/Constants.blade.php');
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
          <a href = "./Logout.blade.php" style="text-decoration: none; color: black" class="wrapper-inner">Logout</a>
          <a href = "./UpdatePassword.blade.php?account_id=<?= $account_id=$_GET['account_id']?>" style="text-decoration: none; color: black" class="wrapper-inner">UpdatePassword</a>
          <a href = "../../lesson/AddLesson.blade.php?account_id=<?= $account_id=$_GET['account_id']?>" style="text-decoration: none; color: black" class="wrapper-inner">RegisterLesson</a>
        </div>
      </div>
    </div>
  </body>
</html>
