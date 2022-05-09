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
    <title>English Conversation Online</title>
    <link rel="stylesheet" href="./css/Account.css">
    <link rel="stylesheet" href="./css/Forms.css">
  </head>
  <body>
    <div style="background-color: whitesmoke; height: 80%">
      <div class="flex">
        <img src="./images/world.webp" style="width: 500px; height: 400px; margin:100px 0 0 200px">
        <div style="flex-flow: column; margin: 190px 0 0 50px;">
        <strong style="font-size: 30px;">
          Say hello to your<br>
          private English tutor<br>
        </strong>
        <strong style="font-size: 16px;padding-top: 10px; display: inline-block">
          Become fluent faster speaker lessons<br>
          tailored to your goals.
        </strong>
        </div>
      </div>
    </div>
    <div style="background-color: yellow; height: 55%">

    </div>
    <div style="background-color: salmon; height: 50%">

    </div>
  </body>
</html>
<?php include "./account/partials/ClientFooter.tpl"?>
