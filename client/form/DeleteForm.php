<?php
include "../partials/DeHeader.tpl";

$client_id = $_GET['client_id'];
$lesson_id = $_GET['lesson_id'];

$sql = " SELECT 
             *
           FROM
             tbl_lesson
         LEFT JOIN 
             tbl_form
           ON 
             tbl_lesson.lesson_id = tbl_form.lesson_id
         LEFT JOIN 
             tbl_account
           ON 
             tbl_lesson.account_id = tbl_account.account_id 
         WHERE 
               tbl_form.client_id = '$client_id'
             AND  
               tbl_form.lesson_id = '$lesson_id'  
       ";
$rec = mysqli_query($connect, $sql);
if ($rec == true)
{
  $count = mysqli_num_rows($rec);
  if($count == 1)
  {
    $row = mysqli_fetch_assoc($rec);
    $asking      = $row['asking'];
    $form_id     = $row['form_id'];
    $course      = $row['course'];
    $description = $row['description'];
    $username    = $row['user_name'];
    $image　　　  = $row['image_name'];

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
    </div>
    <div style="display: flex">

    </div>
    <strong style="text-align: left; margin: 15px 0 30px 30px;display: inline-block">Are you Sure? </strong>
  </body>
</html>

<?php include "../partials/FooterEd.tpl" ?>