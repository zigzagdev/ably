<?php
include('../account/partials/Header.blade.php');
  if(isset($_SESSION['fail-lesson']))
  {
    echo $_SESSION['fail-lesson'];
    unset($_SESSION['fail-lesson']);
  }
  if(isset($_SESSION['lesson-upd-fail']))
  {
    echo $_SESSION['lesson-upd-fail'];
    unset($_SESSION['lesson-upd-fail']);
  }

  if(isset($_GET['lesson_id']))
  {
    $lesson_id = $_GET['lesson_id'];
    $sql2 = "SELECT * FROM tbl_lesson  where lesson_id= $lesson_id";
    $rec2 = mysqli_query($connect, $sql2);

    if ($rec2 == true) {
        $count = mysqli_num_rows($rec2);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($rec2);
            $course = $row['course'];
            $content = $row['content'];
            $day = $row['day'];

        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}
?>
<html>
  <head>
    <title>UpdateLesson</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
  </body>
</html>
<?php
  if(isset($_POST['submit']))
  {
    $course     = $_POST['course'];
    $content    = $_POST['content'];
    $deadline       = $_POST['deadline'];
    $updated_at = date('Y-m-d H:i:s');


    if (empty($course) || empty($content) || empty($deadline) )
    {
      $_SESSION['fail-lesson'] = "<div class='fail'>Failed to Upload Lesson. </div>";
      $url = "http://localhost:8001/lesson/UpdateLesson.php?account_id=$account_id";
      header('Location:'.$url,true , 401);
      die();
    }

    $sql2 = " UPDATE tbl_lesson SET  
                     course      = '$course'
                     ,content    = '$content'
                     ,day        = '$day' 
                     ,updated_att= '$updated_at'
               WHERE 
                     lesson_id=$lesson_id
            ";
    $rec2 = mysqli_query($connect, $sql2) or die(mysqli_error($connect));


    if($rec2 == true)
    {
        $url = "http://localhost:8001/lesson/ManageLesson.blade.php?account_id=$account_id";
        $_SESSION['lesson-upd'] = "<div class='success'>Account Updated Successfully.</div>";
        header('Location:' .$url,true , 302);
    }
    else
    {
        $_SESSION['lesson-upd-fail'] = "<div class='fail'><i style='color: #ff6666;font-size: 20px'>Failed to Update Account.</i></div>";
        $url = "http://localhost:8001/lesson/UpdateLesson.php?account_id=$account_id&lesson_id=$lesson_id";
        header('Location:' .$url,true , 401);
        die();
    }
}

include('../account/partials/Footer.tpl'); ?>


