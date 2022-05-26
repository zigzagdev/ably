<?php include "../../config/Constants.blade.php"; ?>

<html>
  <head>
    <link rel="stylesheet" href="../../css/Account.css">
  </head>
  <header style="background-color: ghostwhite;padding-bottom: 20px">
    <div class="infooutline">
      <div class="logo">
        <h1 class="hchar" style="color: #125EAE;">FormRelative</h1>
      </div>
      <div class="account text-center">
        <div class="wrapper">
          <a href = "../../client/SLogout.blade.php" style="text-decoration: none; color: black" class="wrapper-inner">Logout</a>
          <a href = "../../LIndex.blade.php?client_id=<?= $client_id=$_GET['client_id']?>" style="text-decoration: none; color: black" class="wrapper-inner">TopPage</a>
          <a href = "../UpPassCli.blade.php?client_id=<?= $client_id=$_GET['client_id']?>" style="text-decoration: none; color: black" class="wrapper-inner">PasswordChange</a>
        </div>
      </div>
    </div>
  </header>
</html>