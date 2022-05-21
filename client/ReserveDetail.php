<?php
include './partials/HeaderEd.blade.php';
include "../config/Constants.blade.php";

if(isset($_SESSION['asking_f']))
{
  echo  $_SESSION['asking_f'];
  unset($_SESSION['asking_f']);
}

$client_id = $_GET['client_id'];
$lesson_id = $_GET['lesson_id'];

$sql = "
        SELECT
            user_name, content, image_name, course
        FROM
            tbl_lesson
            LEFT JOIN
              tbl_account
              ON tbl_lesson.account_id = tbl_account.account_id
        WHERE 
               lesson_id='$lesson_id'
        ";
$rec = mysqli_query($connect, $sql);

if($rec == TRUE) {
  $count = mysqli_num_rows($rec);
  if ($count >= 0) {
    while ($rows = mysqli_fetch_array($rec)) {
      $course      = $rows['course'];
      $content     = $rows['content'];
      $user_name   = $rows['user_name'];
      $image_name  = $rows['image_name'];
    }
  }
}
?>

<html>
  <head>
    <title>LessonDetail</title>
    <link rel="stylesheet" href="../../css/Account.css">
    <link rel="stylesheet" href="../../css/Forms.css">
  </head>
  <body style="background: linear-gradient(180deg, whitesmoke 5%, floralwhite 60%, snow 40%, snow 100%);">
    <div style="margin: 10px 130px">
    </div>
  </body>
</html>

<?php
//$rec = mysqli_query($connect, $sql);
//
//if($rec == TRUE)
//{
//  $count = mysqli_num_rows($rec);
//  if ($count >= 0)
//  {
//    $_SESSION['asking_f'] =  "<div class='success'>You already register this course.</div>";
//    header("Location:http://localhost:8001/LIndex.blade.php?client_id=$client_id");
//    die();
//  }
//}
