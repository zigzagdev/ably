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
 }
?>

<html>
  <head>
    <title>ReservePage</title>
    <link rel="stylesheet" href="../../css/Account.css">
    <link rel="stylesheet" href="../../css/Forms.css">
  </head>
  <body style="background: linear-gradient(180deg, whitesmoke 5%, floralwhite 60%, seashell 40%, snow 100%);">
    <div style="margin: 0 130px">
      <div>

      </div>
    </div>
  </body>
</html>

<?php include('../../client/partials/FooterEd.tpl'); ?>