<?php
include('../partials/FormHeader.blade.php');

if(isset($_SESSION['asking_f']))
{
  echo  $_SESSION['asking_f'];
  unset($_SESSION['asking_f']);
}

 $client_id = $_GET['client_id'];

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

<?php include('./client/partials/FooterEd.tpl'); ?>