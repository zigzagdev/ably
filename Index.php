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
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  </head>
  <body>
    <div style="height: 80%; background: linear-gradient(80deg, whitesmoke 20%,skyblue 40%, lightsteelblue 40%, powderblue 50%);">
      <div class="flex">
        <img src="./images/world.webp" style="width: 500px; height: 520px; margin:30px 0 0 200px">
        <div style="flex-flow: column; margin: 190px 0 0 50px;">
        <strong style="font-size: 30px;">
          Say hello to your<br>
          private English tutor<br>
        </strong>
        <strong style="font-size: 16px;padding-top: 10px;margin-top: 16px; display: inline-block">
          Become fluent faster speaker lessons<br>
          tailored to your goals.
        </strong>
        </div>
      </div>
    </div>
    <div style="height: 60%; background: linear-gradient(180deg, aliceblue 0%, gold 60%, gold 40%, palegoldenrod 100%);};">
      <div class="flex">
        <img src="./images/chat.webp" style="width: 400px; height: 240px; margin:50px 0 0 320px">
        <div style="flex-flow: column; margin: 90px 0 0 50px;">
          <strong style="font-size: 30px;">
            English immersion<br>
            from anywhere<br>
          </strong>
          <strong style="font-size: 16px;padding-top: 10px;margin-top: 16px; display: inline-block">
            Build English proficiency and confidence through real conversations<br>
            with friendly tutors from the US, UK, Australia, and more. <br>
            All you need is your device!
          </strong>
        </div>
      </div>
    </div>
    <div style=" background: linear-gradient(40deg, salmon 20%, lightcoral 30%, lightsalmon 50%, palegoldenrod 100%);">
      <div style="display: flex; padding: 150px 0 100px 250px">
        <div style="width: 450px; height: 150px; border-radius: 10px; background-color: gold; margin: 0 20px">
          aa
        </div>
        <div style="width: 450px; height: 150px; border-radius: 10px; background-color: gold; margin: 0 20px">
          aa
        </div>
      </div>
    </div>
  </body>
</html>
<?php include "./account/partials/ClientFooter.tpl"?>
