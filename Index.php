<?php
include('./config/Constants.blade.php');
include('./account/partials/ClientHeader.blade.php');

  if(isset($_SESSION['delete']))
  {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
  }
  if(isset($_SESSION['dlt_cli']))
  {
    echo $_SESSION['dlt_cli'];
    unset($_SESSION['dlt_cli']);
  }
  if(isset($_SESSION['delete_ac']))
  {
    echo $_SESSION['delete_ac'];
    unset($_SESSION['delete_ac']);
  }
  if(isset($_SESSION['ac_logout']))
  {
    echo $_SESSION['ac_logout'];
    unset($_SESSION['ac_logout']);
  }
?>
<html>
  <head>
    <title>English Conversation Online.</title>
    <link rel="stylesheet" href="./css/Account.css">
    <link rel="stylesheet" href="./css/Forms.css">
  </head>
  <body>
    <div style="background-color: whitesmoke; height: 80%">

    </div>
    <div style="background-color: yellow; height: 40%">

    </div>
    <div style="background-color: salmon; height: 40%">

    </div>
    <div style="background-color: red; height: 40%">

    </div>
  </body>
</html>
<?php include "./account/partials/ClientFooter.tpl"?>
