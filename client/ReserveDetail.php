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
            user_name, content, image_name, course, description
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
      $description = $rows['description'];
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
  <body style="background: linear-gradient(90deg, whitesmoke 5%, floralwhite 55%, snow 40%, snow 100%);">
    <div style="margin: 40px 130px 80px 130px">
      <div class="mainaccount"style="background: linear-gradient(180deg, lightblue 5%, floralwhite 55%, ghostwhite 40%);padding-bottom: 10px" >
        <li style="list-style: none;  margin:27px 0 7px 0; padding-top: 20px; text-align: center">
          <b style="font-size: 20px;width:70px; vertical-align: 70%; ">Your selected Course.</b>
        </li>
        <li style="list-style: none;  margin:27px 0 17px 30px">
          <b style="font-size: 20px;margin-right:160px; float: left;">
            TutorName
          </b><br><br>
          <b style="font-size: 20px; margin-right: 10px;">
            <?php echo $user_name ?>
          </b>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:27px 0 17px 30px">
          <b style="font-size: 20px;margin-right:160px; float: left;">
            CourseName
          </b><br><br>
          <b style="font-size: 20px; margin-right: 10px;">
            <?php echo $course ?>
          </b>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;margin-right:160px; float: left;">
            About me
          </b><br><br>
          <b style="font-size: 20px;overflow-wrap: break-word;"><?php echo $description ?></b>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:160px; float: left;">
            LessonDetail
          </b><br><br>
          <b style="font-size: 20px;overflow-wrap: break-word;"><?php echo $content ?></b>
        </li>
      </div>
      <div style="margin:60px 0; text-align: center">
        <div style="margin: 0 10px 20px 10px">
          <a class="btn-primary" style="margin: 0 7px 0 7px" href="http://localhost:8001/client/form/Asking.php?client_id=<?=$client_id;?>&lesson_id=<?=$_GET['lesson_id']?>">
            Reserve the course
          </a>
<?php
$hostname = $_SERVER['HTTP_HOST'];
  if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$hostname) !== false))
  {
    echo '<a href="'. $_SERVER['HTTP_REFERER']. '" class="btn-primary" style="margin-left: 10px">Return Page</a>';
  }
?>
        </div>
      </div>
    </div>
  </body>
</html>
<?php include "./partials/FooterEd.tpl" ?>
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
