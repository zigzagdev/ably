<?php
include('./header/EachHeader.tpl');

  if(isset($_SESSION['delete_f_lesson']))
  {
    echo $_SESSION['delete_f_lesson'];
    unset($_SESSION['delete_f_lesson']);
  }
  $lesson_id = $_GET['lesson_id'];
  $sql= "SELECT * FROM tbl_lesson WHERE lesson_id = $lesson_id";
  $rec = mysqli_query($connect, $sql);
  if ($rec == TRUE)
  {
    $count = mysqli_num_rows($rec);
    $on = 1;
    if ($count > 0)
    {
      while ($rows = mysqli_fetch_array($rec))
      {
        $course      = $rows['course'];
        $description = $rows['description'];
        $deadline    = $rows['deadline'];
        $account_id  = $rows['account_id'];
      }
    }
  }

?>
<html>
  <head>
    <title>DeleteLesson</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <div style="margin: 0 130px">
      <div class="mainaccount">
        <form method="post" action="DeleteLessonDeed.php?lesson_id=<?= $lesson_id ?>">
          <li style="list-style: none;  margin:27px 0 7px 70px; padding-top: 20px">
            <b style="font-size: 20px;width:70px;margin-right:10px; vertical-align: 70%">Delete your Lesson</b>
          </li>
          <li style="list-style: none;  margin:47px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:160px; float: left;">
              CourseName
            </b>
            <b style="font-size: 20px; margin-right: 170px"><?php echo $course ?></b>
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:160px; float: left;">
              Content
            </b>
            <b style="font-size: 20px; margin-right: 170px"><?php echo $description ?></b>
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:160px; float: left;">
              Deadline
            </b>
            <b style="font-size: 20px; margin-right: 170px"><?php echo $deadline ?></b>
          </li>
          <div style="margin-bottom:10px ; text-align: center; padding-top: 20px">
            <input type="submit" class="btn-secondary" style="margin-right: 10px" value="Are you sure to delete ?">
<?php
  $hostname = $_SERVER['HTTP_HOST'];
  if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$hostname) !== false))
  {
    echo '<a href="'. $_SERVER['HTTP_REFERER']. '" class="btn-primary" style="margin-left: 10px">Return</a>';
  }
?>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>

<?php include('../account/partials/Footer.tpl'); ?>


