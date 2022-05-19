<?php
include('../partials/FormHeader.blade.php');

  if(isset($_SESSION['asking_f']))
  {
    echo  $_SESSION['asking_f'];
    unset($_SESSION['asking_f']);
  }
  $client_id = $_GET['client_id'];
  if(isset($_POST['submit']))
  {
    $asking = $_POST['asking'];
    if (8 > mb_strlen($asking, 'UTF-8')|| 200 <  mb_strlen($asking, 'UTF-8'))
    {
      $_SESSION['asking_f'] = "<div class='success'>Please fill your asking comment in 8~200 words !</div>";
    }
    //  preg_match
    if (!preg_match("/^[a-zA-Z-' ]*$/", $asking)) {
      $_SESSION['asking_f'] = "<div class='success'>Only English is valid.!</div>";
      header("Location: http:/localhost:8001/client/form/Asking.php?client_id=$client_id");
    }
 }
?>

<html>
  <head>
    <title>ReservePage</title>
    <link rel="stylesheet" href="../../css/Account.css">
    <link rel="stylesheet" href="../../css/Forms.css">
  </head>
  <body style="background: linear-gradient(180deg, whitesmoke 5%, floralwhite 60%, snow 40%, snow 100%);">
    <div style="margin: 10px 130px">
      <div class="mainaccount">

      </div>
    </div>
  </body>
</html>

<?php include('../partials/FooterEd.tpl'); ?>