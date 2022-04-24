<?php
include('../account/partials/LoginAccount.blade.php');

  if(isset($_SESSION['lesson-upd']))
  {
    echo $_SESSION['lesson-upd'];
    unset($_SESSION['lesson-upd']);
  }

  if(isset($_SESSION['change-lesson']))
  {
    echo $_SESSION['change-lesson'];
    unset($_SESSION['change-lesson']);
  }

  $sql = "SELECT * FROM tbl_lesson inner join tbl_account on tbl_lesson.account_id = tbl_account.account_id";
  $rec = mysqli_query($connect, $sql);

  if($rec == TRUE)
  {
    $count = mysqli_num_rows($rec);
    if ($count >= 0)
    {
      while ($rows = mysqli_fetch_array($rec))
      {
        $course     = $rows['course'];
        $content    = $rows['content'];
        $deadline   = $rows['deadline'];
        $lesson_id  = $rows['lesson_id'];
        $user_name  = $rows['user_name'];
        $created_at = $rows['created_at'];
      }
    }
  }
?>

<html>
  <head>
    <title>ManageLesson</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <div style="margin: 0 70px">
      <div class="cardline">
<?php foreach($rec as $key => $val ){
?>      <div class="card">
          <div class="course" style="margin-bottom: 7px">
            <strong style="font-size: 16px;">Course Level</strong>
            <i style="font-size: 17px; color: darkblue; padding-left: 5px"><?php  echo $course ;?></i>
          </div>
          <div class="content">
            <strong style="font-size: 16px;">Course Description</strong>
            <div style="margin: 3px 5px 7px 5px">
              <i style="font-size: 17px; color: darkblue; overflow-wrap: break-word;">
                <?php  echo mb_strimwidth( strip_tags( $content ), 0, 60, '…', 'UTF-8' ); ;?>
              </i>
            </div>
            <strong style="font-size: 16px;">Course Deadline</strong><br>
            <i style="font-size: 17px; color: darkblue; padding-left: 80px">〜 <?php  echo $created_at ;?></i>
          </div>
        </div>
<?php } ?>
      </div>
    </div>
  </body>
</html>
<!--Main Section -->

<?php include('../account/partials/Footer.tpl') ?>
