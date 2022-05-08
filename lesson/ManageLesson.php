<?php
include('./header/LessonHeader.blade.php');

  if(isset($_SESSION['lesson-upd']))
  {
    echo $_SESSION['lesson-upd'];
    unset($_SESSION['lesson-upd']);
  }
  if(isset($_SESSION['lesson_add']))
  {
    echo $_SESSION['lesson_add'];
    unset($_SESSION['lesson_add']);
  }

  if(isset($_SESSION['change-lesson']))
  {
    echo $_SESSION['change-lesson'];
    unset($_SESSION['change-lesson']);
  }
  if(isset($_SESSION['lesson_dlt']))
  {
    echo $_SESSION['lesson_dlt'];
    unset($_SESSION['lesson_dlt']);
  }
  if(isset($_SESSION['delete_lesson']))
  {
    echo $_SESSION['delete_lesson'];
    unset($_SESSION['delete_lesson']);
  }

  $account_id = $_GET['account_id'];
  $sql = "
           SELECT 
               * 
           FROM 
               tbl_lesson 
               INNER JOIN tbl_account 
                 ON tbl_lesson.account_id = tbl_account.account_id 
           WHERE 
               tbl_lesson.account_id=$account_id
          ";
  $rec = mysqli_query($connect, $sql);

  if($rec == TRUE)
  {
    $count = mysqli_num_rows($rec);
    if ($count >= 0)
    {
      while ($rows = mysqli_fetch_array($rec))
      {
        $course      = $rows['course'];
        $description = $rows['description'];
        $deadline    = $rows['deadline'];
        $lesson_id   = $rows['lesson_id'];
        $created_at  = $rows['created_at'];
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
    <div style="margin: 0 210px">
      <div class="cardline">
<?php foreach($rec as $key ){
?>      <a href="EachLesson.php?lesson_id=<?=$key['lesson_id']?>" class="card" style="margin-bottom: 7px; text-decoration: none; color: black">
          <div class="course" style="margin-bottom: 7px">
            <strong style="font-size: 16px;">Course Level</strong><br>
            <i style="font-size: 17px; color: darkblue; padding-left: 5px"><?php  echo $key['course'] ;?></i>
          </div>
          <div class="content">
            <strong style="font-size: 16px;">Course Description</strong>
            <div style="margin: 3px 5px 7px 5px">
              <i style="font-size: 17px; color: darkblue; overflow-wrap: break-word;">
                <?php  echo mb_strimwidth( strip_tags( $key['description'] ), 0, 60, '…', 'UTF-8' ); ;?>
              </i>
            </div>
            <strong style="font-size: 16px;">Course Deadline</strong><br>
            <i style="font-size: 17px; color: darkblue; padding-left: 5px"><?php echo $key['deadline'] ;?></i>
          </div>
        </a>
<?php } ?>
      </div>
    </div>
  </body>
</html>

<?php include('../account/partials/Footer.tpl') ?>
