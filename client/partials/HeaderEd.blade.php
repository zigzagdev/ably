<?php
include ('../config/Constants.blade.php');
$client_id = $_GET['client_id']
?>

<html>
  <head>
  <link rel="stylesheet" href="../../css/Account.css">
  </head>
  <body style="background-color: ghostwhite">
    <div class="infooutline">
      <div class="logo">
        <h1 class="hchar" style="color: #125EAE">Learn at here..!</h1>
      </div>
      <div class="account text-center">
        <div class="wrapper">
          <a href = "../SLogout.blade.php" style="text-decoration: none; color: black" class="wrapper-inner">Logout</a>
          <a href = "../../LIndex.blade.php" style="text-decoration: none; color: black" class="wrapper-inner">Index</a>
        </div>
      </div>
    </div>
  </body>
</html>