<?php include "../../config/Constants.blade.php"; ?>

<html>
  <head>
    <link rel="stylesheet" href="../../css/Account.css">
  </head>
  <header style="background-color: ghostwhite">
    <div class="infooutline">
      <div class="logo">
        <h1 class="hchar" style="color: #125EAE">Learn at here..!</h1>
      </div>
      <div class="account text-center">
        <div class="wrapper">
          <a href = "../SLogout.blade.php" style="text-decoration: none; color: black" class="wrapper-inner">Logout</a>
          <a href = "../../LIndex.blade.php?client_id=<?= $client_id?>" style="text-decoration: none; color: black" class="wrapper-inner">TopPage</a>
          <a href = "../UpPassCli.blade.php?client_id=<?= $client_id?>" style="text-decoration: none; color: black" class="wrapper-inner">PasswordChange</a>
        </div>
      </div>
    </div>
  </header>
</html>
