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
    $image       = $row['image_name'];
    $deadline    = $row['deadline'];
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
    <div style="margin: 10px 130px 30px 130px">
      <strong style="text-align: left; margin: 35px 0 30px 1px;display: inline-block">Delete Form confirm</strong><br>
    </div>
    <div style="display: flex; padding-bottom: 20px">
      <div class="cardoutline2" style="margin:auto;">
        <div style="margin: 20px 0 0 40px; display: flex">
          <img src="../../images/profile/<?php echo $image; ?>" style="width: 68px; height: 68px; border-radius: 50px">
          <span style="margin: 10px;display: inline-block">
            <strong style="margin-left:20px; font-size: 25px"><?php echo $username ?></strong><br>
            <span style="padding-top: 40px">
              <strong style="margin: 0 20px"></strong>
            </span>
          </span>
        </div>
        <div style="margin: 35px 0 0 40px;">
          <strong><?php echo $course ?></strong>
        </div>
        <div style="margin: 35px 0 0 40px;">
          <strong style="overflow-wrap: break-word">
            <?php  echo mb_strimwidth( strip_tags( $description), 0, 60, '…', 'UTF-8' );?>
          </strong>
        </div>
      </div>
      <div class="cardoutline2" style="margin:auto;">
        <div style=" margin-top: 20px; text-align: center">
          <strong style="color: darkblue">YourForm</strong>
        </div>
        <div style="margin: 20px 0 0 40px; display: flex">
          <span style="margin: 10px;display: inline-block">
            <strong style="color: darkblue">LessonDay</strong><br>
            <strong style="margin-left:20px; font-size: 25px"><?php echo $deadline?></strong><br>
            <span style="padding-top: 40px">
              <strong style="font-size: 25px">Asking</strong><br>
              <strong style="font-size: 25px"><?php echo $asking ?></strong><br>
            </span>
          </span>
        </div>
      </div>
    </div>
    <div style="text-align: center">
     <strong style="text-align: left; margin: 15px 0 30px 30px;display: inline-block">Are you Sure? </strong>
      <div style="display: flex">
        <button type="button" onclick=history.back() class="btn-primary" style="height: 53px; width: 103px;">
          Return
        </button>
      </div>
    </div>
  </body>
</html>

<?php include "../partials/FooterEd.tpl"