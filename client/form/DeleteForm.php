<?php
include "../partials/DeHeader.tpl";

$client_id = $_GET['client_id'];
$lesson_id = $_GET['lesson_id'];

$sql = " SELECT 
             *
         FROM
             tbl_form
           WHERE 
               client_id = '$client_id'
             AND  
               lesson_id = '$lesson_id'  
       ";
$rec = mysqli_query($connect, $sql);
  if ($rec == true)
  {
    $count = mysqli_num_rows($rec);
    if($count == 1)
    {
      $row = mysqli_fetch_assoc($rec);
      $asking = $row['asking'];
      $form_id = $row['form_id'];
    } else {
      header('Location: '. $_SERVER['HTTP_REFERER']);
      die();
    }
  }
?>

<html>
  <head>
    <title>DeleteReservation</title>
    <link rel="stylesheet" href="../../css/Account.css">
    <link rel="stylesheet" href="../../css/Forms.css">
  </head>
  <body>
    <div style="margin: 10px 130px">
      <strong style="text-align: left; margin: 35px 0 30px 30px;display: inline-block">Delete Form confirm</strong><br>
      <strong style="text-align: left; margin: 35px 0 30px 30px;display: inline-block">Are you Sure? </strong>
    </div>
  </body>
</html>

<?php include "../partials/FooterEd.tpl" ?>

