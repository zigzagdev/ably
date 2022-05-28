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
        <div class="wrapper" style="margin-right: 100px">
          <a href = "../../LIndex.blade.php?client_id=<?= $client_id=$_GET['client_id']?>" style="text-decoration: none; color: black" class="wrapper-inner">
            TopPage
          </a>
        </div>
      </div>
    </div>
  </header>
</html>