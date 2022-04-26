<?php
include ('./header/LessonHeader.blade.php');

  $account_id = $_GET['account_id'];
  $sql= "SELECT * FROM tbl_lesson WHERE account_id = $account_id";
  $rec = mysqli_query($connect, $sql);
  if ($rec == TRUE)
  {
    $count = mysqli_num_rows($rec);
    $on = 1;
    if ($count > 0)
    {
      while ($rows = mysqli_fetch_array($rec))
      {
        $course   = $rows['course'];
        $content  = $rows['content'];
        $deadline = $rows['deadline'];
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
        <form method="post" action="/">
          <li style="list-style: none;  margin:27px 0 7px 70px; padding-top: 20px">
            <b style="font-size: 20px;width:70px;margin-right:10px; vertical-align: 70%">Delete your Lesson</b>
          </li>
          <li style="list-style: none;  margin:47px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:160px; float: left;">
              Name
            </b>
            <b style="font-size: 20px; margin-right: 170px"><?php echo $course ?></b>
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:160px; float: left;">
              Email
            </b>
            <b style="font-size: 20px; margin-right: 170px"></b>
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:160px; float: left;">
             Content
            </b>
            <b style="font-size: 20px; margin-right: 170px">
            </b>
            <b style="font-size: 20px; margin-right: 170px"><?php echo $content ?></b>
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        </form>
      </div>
      <div style="margin-bottom:40px ; text-align: center">
        <form action="" method="post">
          <input type="submit" class="btn-secondary" style="margin-right: 10px" value="Are you sure to delete ?">
<?php
  $hostname = $_SERVER['HTTP_HOST'];
  if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$hostname) !== false))
  {
    echo '<a href="' . $_SERVER['HTTP_REFERER'] . '" class="btn-primary" style="margin-left: 10px">Return</a>';
  }
?>
        </form>
      </div>
    </div>
  </body>
</html>

<?php
include('../account/partials/Footer.tpl');

  $lesson_id= $_GET['lesson_id'];
  $account_id = $_GET['account_id'];

  $sql2= "DELETE FROM tbl_lesson WHERE lesson_id=$lesson_id";
  $rec2= mysqli_query($connect, $sql2);

  if($rec2 == TRUE)
  {
    $account_id = $_GET['account_id'];
    $_SESSION['lesson_dlt'] = "<div class='success'>Delete Lesson Successfully.</div>";
    $url = "http://localhost:8001/lesson/ManageLesson.php?account_id=$account_id";
    header('Location:' .$url,true , 302);
  } else
  {
    $_SESSION['lesson-dlt-error'] = "<div class='error'>Failed to Delete lesson.</div>";
    $url = "http://localhost:8001/lesson/UpdateLesson.php?lesson_id=$lesson_id";
    header('Location:' .$url,true , 401);
  }
?>


