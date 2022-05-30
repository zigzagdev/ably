<?php
include "./header/EachHeader.tpl";

if(isset($_SESSION['fail_lesson']))
{
  echo $_SESSION['fail_lesson'];
  unset($_SESSION['fail_lesson']);
}
$lesson_id = $_GET['lesson_id'];

$sql = "SELECT * FROM tbl_lesson WHERE lesson_id= '$lesson_id'";

$rec = mysqli_query($connect, $sql);

if($rec == TRUE) {
  $count = mysqli_num_rows($rec);
  if ($count >= 0) {
    while ($rows = mysqli_fetch_array($rec)) {
      $course      = $rows['course'];
      $description = $rows['description'];
      $deadline    = $rows['deadline'];
      $account_id  = $rows['account_id'];
      $created_at  = $rows['created_at'];
    }
  }
}

?>

<html>
  <head>
    <title>EachLessonPage</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <div style="margin: 0 180px">
      <div class="mainaccount">
        <li style="list-style: none;  margin:27px 0 7px 70px; padding-top: 20px">
          <b style="font-size: 20px;width:70px;margin-left:150px; vertical-align: 70%; ">Lesson Detail</b>
        </li>
        <li style="list-style: none;  margin:27px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:160px; float: left;">
            CourseName
          </b>
          <b style="font-size: 20px; margin-right: 10px"><?php echo $course ?></b>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:160px; float: left;">
            LessonContent
          </b><br><br>
          <b style="font-size: 20px;overflow-wrap: break-word;"><?php echo $description ?></b>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:160px; float: left;">
            Deadline
          </b>
          <b style="font-size: 20px; margin-right: 170px"><?php echo $deadline ?></b>
        </li>
      </div>
      <div style="margin:60px 0; text-align: center">
        <div style="margin: 0 10px 20px 10px">
          <a class="btn-primary" style="margin: 0 7px 0 7px" href="UpdateLesson.blade.php?lesson_id=<?=$lesson_id=$_GET['lesson_id'];?>">
            Update your Lesson
          </a>
          <a class="btn-delete" style="margin: 0 7px 0 7px;" href="DeleteLesson.php?lesson_id=<?= $lesson_id=$_GET['lesson_id'];?>">
            Delete your Lesson
          </a>
<?php
  $hostname = $_SERVER['HTTP_HOST'];
  if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$hostname) !== false))
  {
    echo '<a href="'. $_SERVER['HTTP_REFERER']. '" class="btn-primary" style="margin-left: 10px">Return</a>';
  }
?>
        </div>
      </div>
    </div>
  </body>
</html>
<?php  include "../account/partials/Footer.tpl" ?>